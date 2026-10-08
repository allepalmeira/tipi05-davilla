# Atualização da API no Servidor e Testes — Confeitaria DaVilla

Atualização da API Laravel em produção, sincronização segura das migrations, instalação do Laravel Sanctum e validação das rotas autenticadas com Postman.

## 01. Objetivo

Esta documentação orienta a atualização da API da Confeitaria DaVilla no servidor Plesk, partindo de um projeto Laravel já publicado e funcionando. O foco é atualizar o código vindo do GitHub, instalar as novas dependências da API, sincronizar as migrations com segurança e validar a autenticação com Laravel Sanctum.

## 02. Cenário utilizado

Projeto no servidor:
`/var/www/vhosts/smpsistema.com.br/xyzcode.tipi5.smpsistema.com.br/tipi05-davilla`

Aplicação Laravel:
`tipi05-davilla/src`

Acesso público:
`https://xyzcode.tipi5.smpsistema.com.br/davilla/`

API:
`https://xyzcode.tipi5.smpsistema.com.br/davilla/api/v1`

## 03. Acessar o projeto pelo Terminal SSH

Entre no Terminal SSH do subdomínio e execute:


$ pwd
$ cd /var/www/vhosts/smpsistema.com.br/xyzcode.tipi5.smpsistema.com.br
$ ls -la
$ cd tipi05-davilla
$ pwd


O caminho final esperado é:


/var/www/vhosts/smpsistema.com.br/xyzcode.tipi5.smpsistema.com.br/tipi05-davilla

## 04. Verificar o estado do Git antes de atualizar

Antes do `git pull`, valide se existem mudanças locais:


$ git status
$ git diff --summary
$ git diff -- src/public/index.php


Se aparecerem apenas mudanças de modo, como `100644 => 100755`, não é alteração de conteúdo. Nesse servidor, usamos:


$ git config core.fileMode false
$ git status


O esperado é:


nothing to commit, working tree clean

## 05. Buscar e aplicar as atualizações do GitHub

Atualize as referências remotas:


$ git fetch origin
$ git log --oneline HEAD..origin/main
$ git status -sb


Se o servidor estiver atrás da `origin/main`, atualize sem criar merge:


$ git pull --ff-only origin main
$ git log --oneline -5


No caso validado, o servidor avançou até o commit da autenticação com Sanctum.

## 06. Atualizar as dependências PHP no Plesk

Neste servidor o comando `composer` não está disponível no Terminal SSH por causa do ambiente chroot. Portanto, usamos o Composer do próprio Plesk.


Caminho no painel:




Websites e Domínios
→ xyzcode.tipi5.smpsistema.com.br
→ PHP Composer


Configure a pasta da aplicação como:


/xyzcode.tipi5.smpsistema.com.br/tipi05-davilla/src


Use a opção **Instalar**, e não **Atualizar**, para respeitar o `composer.lock`.


Depois da instalação, confirme no SSH:




$ cd src
$ ls -la vendor/laravel/sanctum

## 07. Limpar caches e ajustar permissões

Com as dependências instaladas:


$ /opt/plesk/php/8.4/bin/php artisan optimize:clear
$ chmod -R 775 storage
$ chmod -R 775 bootstrap/cache


Depois valide o site e a API pública:


https://xyzcode.tipi5.smpsistema.com.br/davilla/
https://xyzcode.tipi5.smpsistema.com.br/davilla/api/v1/status


A resposta esperada do status é:


{
  "success": true,
  "data": {
    "aplicacao": "Confeitaria DaVilla",
    "api": "v1",
    "status": "online"
  }
}

## 08. Verificar as migrations antes de alterar o banco

Execute:


$ /opt/plesk/php/8.4/bin/php artisan migrate:status


No nosso cenário, as três migrations padrão estavam como **Ran**, mas as migrations de negócio geradas depois apareciam como **Pending**, mesmo com as tabelas já existentes no banco.


**Importante:** não executar `migrate --force` nesse momento, porque o Laravel tentaria criar novamente tabelas já existentes.

## 09. Registrar a baseline das migrations

Como o banco já tinha sido importado antes da criação das migrations de negócio, registramos a baseline diretamente na tabela `migrations` pelo phpMyAdmin.


Primeiro confirme os registros existentes:




SELECT id, migration, batch
FROM migrations
ORDER BY id;




Depois registre somente as migrations que representam a estrutura já existente. Exemplo do padrão usado:




INSERT INTO migrations (migration, batch)
SELECT '2026_09_08_143451_create_tbl_banner_table', 1
WHERE NOT EXISTS (
    SELECT 1 FROM migrations
    WHERE migration = '2026_09_08_143451_create_tbl_banner_table'
);


Repita o mesmo padrão para todas as migrations de criação e foreign keys da baseline de `2026_09_08`.


Depois confirme novamente:




$ /opt/plesk/php/8.4/bin/php artisan migrate:status


O esperado é que a baseline fique como **Ran** e apenas as migrations realmente novas permaneçam como **Pending**.

## 10. Simular as migrations novas

Com a baseline reconciliada, execute:


$ /opt/plesk/php/8.4/bin/php artisan migrate --pretend


Como o ambiente é `production`, o Laravel pede confirmação. Pode responder **Yes**.


No caso validado, o SQL mostrou somente:




create_tbl_favoritos_table
create_personal_access_tokens_table


Nenhuma tabela histórica foi recriada.

## 11. Aplicar as migrations em produção

Depois de conferir o `--pretend`:


$ /opt/plesk/php/8.4/bin/php artisan migrate --force
$ /opt/plesk/php/8.4/bin/php artisan migrate:status


O resultado validado foi:


2026_09_10_120536_create_tbl_favoritos_table              [2] Ran
2026_09_24_113919_create_personal_access_tokens_table      [2] Ran


Executando novamente:


$ /opt/plesk/php/8.4/bin/php artisan migrate --force


o Laravel respondeu:


INFO  Nothing to migrate.

## 12. Validar as tabelas criadas

No phpMyAdmin:


SHOW TABLES LIKE 'tbl_favoritos';
SHOW TABLES LIKE 'personal_access_tokens';

DESCRIBE tbl_favoritos;
DESCRIBE personal_access_tokens;


As duas tabelas devem existir.

## 13. Validar as rotas da API

No Terminal SSH:


$ /opt/plesk/php/8.4/bin/php artisan route:list --path=api/v1


Rotas esperadas:


POST   api/v1/auth/login
POST   api/v1/auth/logout
GET    api/v1/banners
GET    api/v1/categorias
GET    api/v1/categorias/{id}/produtos
GET    api/v1/cliente
PUT    api/v1/cliente
PATCH  api/v1/cliente
PUT    api/v1/cliente/senha
GET    api/v1/produtos
GET    api/v1/produtos/{slug}
GET    api/v1/status

## 14. Criar um cliente de teste para a autenticação

Se `tbl_clientes` estiver vazio, crie um cliente de teste.


Gere primeiro uma senha com bcrypt:




$ /opt/plesk/php/8.4/bin/php -r "echo password_hash('12345678', PASSWORD_BCRYPT), PHP_EOL;"


O hash deve começar com `$2y$` e ter 60 caracteres.


Ao inserir o cliente, armazene o hash completo em `senha_cliente`. Nunca grave a senha em texto puro.




Confirme:




SELECT
    id_cliente,
    LEFT(senha_cliente, 4) AS inicio_senha,
    LENGTH(senha_cliente) AS tamanho,
    status_cliente
FROM tbl_clientes;


Esperado:


inicio_senha = $2y$
tamanho      = 60
status       = ATIVO

## 15. Teste 1 — Login no Postman

Crie uma requisição:


POST
https://xyzcode.tipi5.smpsistema.com.br/davilla/api/v1/auth/login


Headers:


Content-Type: application/json
Accept: application/json


Body JSON:


{
  "email": "cliente@davilla.com.br",
  "senha": "12345678",
  "device_name": "postman-producao"
}


Resultado esperado:


HTTP 200 OK
"success": true
"message": "Login realizado com sucesso."
"token": "..."


O `device_name` identifica de onde o token foi criado.

## 16. Teste 2 — Acessar rota protegida

Use o token retornado no login:


GET
https://xyzcode.tipi5.smpsistema.com.br/davilla/api/v1/cliente


No Postman:


Authorization
→ Bearer Token
→ cole o token


Também mantenha:


Accept: application/json


Resultado esperado:


HTTP 200 OK


com os dados do cliente autenticado.

## 17. Teste 3 — Logout

Use o mesmo Bearer Token:


POST
https://xyzcode.tipi5.smpsistema.com.br/davilla/api/v1/auth/logout


Resultado esperado:


HTTP 200 OK

{
  "success": true,
  "message": "Logout realizado com sucesso."
}


O token atual é removido da tabela `personal_access_tokens`.

## 18. Teste 4 — Confirmar que o token foi revogado

Repita:


GET
https://xyzcode.tipi5.smpsistema.com.br/davilla/api/v1/cliente


usando o mesmo token que acabou de fazer logout.


Adicione:




Accept: application/json


Resultado esperado:


HTTP 401 Unauthorized


Se o Postman mostrar uma página HTML com status 200, verifique se ele seguiu automaticamente um redirecionamento. Em **Settings**, desative temporariamente **Automatically follow redirects** para observar o retorno original.

## 19. Fluxo de atualização para próximas versões

Para as próximas atualizações, o fluxo recomendado é:


$ cd /var/www/vhosts/smpsistema.com.br/NOME_DO_SUBDOMINIO/tipi05-davilla
$ git status
$ git fetch origin
$ git log --oneline HEAD..origin/main
$ git pull --ff-only origin main
$ cd src
$ /opt/plesk/php/8.4/bin/php artisan migrate --pretend
$ /opt/plesk/php/8.4/bin/php artisan migrate --force
$ /opt/plesk/php/8.4/bin/php artisan optimize:clear
$ chmod -R 775 storage
$ chmod -R 775 bootstrap/cache


Se houver mudança em `composer.json` ou `composer.lock`, execute a instalação das dependências pelo PHP Composer do Plesk antes de testar a aplicação.

