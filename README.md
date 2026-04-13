# tipi05-davilla

Projeto integrador Back-End da turma TIPI 05 - SENAC SMP.

## Objetivo

Este projeto utiliza:

- Windows
- WSL2 + Ubuntu
- Docker Desktop
- Nginx
- PHP 8.3
- MySQL
- Laravel 13

Estrutura base do projeto:

- `docker/` = infraestrutura
- `src/` = aplicação Laravel
- `docker-compose.yml` = orquestração dos containers

---

## Passo a passo resumido para carregar o projeto

### 1. Clonar o repositório
No Ubuntu/WSL, entre na pasta onde deseja salvar o projeto e rode:

```bash
cd ~/projetos/senac/tipi05
git clone https://github.com/allepalmeira/tipi05-davilla.git
cd tipi05-davilla
```

---

### 2. Subir os containers
Na raiz do projeto:

```bash
docker compose up -d
```

Validar se os serviços estão rodando:

```bash
docker compose ps
```

Esperado:

- `nginx`
- `php`
- `mysql`

---

### 3. Criar o arquivo `.env`
Como o `.env` não sobe para o GitHub, ele precisa ser criado localmente:

```bash
cp src/.env.example src/.env
```

---

### 4. Ajustar o `.env`
Abra o arquivo:

```bash
code src/.env
```

Use esta configuração base:

```env
APP_NAME=ConfeitariaDaVilla
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8080

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=davilla
DB_USERNAME=user
DB_PASSWORD=user

SESSION_DRIVER=file
QUEUE_CONNECTION=sync
CACHE_STORE=file
```

> Dentro do Docker, o host do banco não é `localhost`. O correto é `mysql`.

---

### 5. Instalar as dependências do Laravel
Se a pasta `src/vendor` não existir, rode:

```bash
docker compose run --rm composer install
```

---

### 6. Gerar a chave da aplicação

```bash
docker compose exec php php artisan key:generate
```

Validar:

```bash
grep APP_KEY src/.env
```

---

### 7. Preparar pastas de escrita do Laravel

```bash
mkdir -p src/storage/framework/cache/data
mkdir -p src/storage/framework/sessions
mkdir -p src/storage/framework/views
mkdir -p src/storage/framework/testing
mkdir -p src/storage/logs
mkdir -p src/bootstrap/cache
```

Ajustar permissões:

```bash
sudo chown -R $USER:$USER src
chmod -R 775 src/storage src/bootstrap/cache
```

Se houver problema de escrita em ambiente local:

```bash
chmod -R 777 src/storage src/bootstrap/cache
```

---

### 8. Limpar caches do Laravel

```bash
docker compose exec php php artisan config:clear
docker compose exec php php artisan route:clear
docker compose exec php php artisan view:clear
docker compose exec php php artisan optimize:clear
```

---

### 9. Executar as migrations

```bash
docker compose exec php php artisan migrate
```

Para verificar o status:

```bash
docker compose exec php php artisan migrate:status
```

---

### 10. Acessar o projeto
Abra no navegador:

```text
http://localhost:8080
```

---

## Checklist rápido

```bash
cd ~/projetos/senac/tipi05
git clone https://github.com/allepalmeira/tipi05-davilla.git
cd tipi05-davilla

docker compose up -d
cp src/.env.example src/.env
docker compose run --rm composer install
docker compose exec php php artisan key:generate

mkdir -p src/storage/framework/cache/data
mkdir -p src/storage/framework/sessions
mkdir -p src/storage/framework/views
mkdir -p src/storage/framework/testing
mkdir -p src/storage/logs
mkdir -p src/bootstrap/cache

sudo chown -R $USER:$USER src
chmod -R 775 src/storage src/bootstrap/cache

docker compose exec php php artisan config:clear
docker compose exec php php artisan route:clear
docker compose exec php php artisan view:clear
docker compose exec php php artisan optimize:clear
docker compose exec php php artisan migrate
```

---

## Troubleshooting rápido

### Verificar containers
```bash
docker compose ps
```

### Ver logs do PHP
```bash
docker compose logs php --tail=100
```

### Ver logs do Nginx
```bash
docker compose logs nginx --tail=100
```

### Ver log do Laravel
```bash
docker compose exec php tail -n 100 storage/logs/laravel.log
```

---

## Observações importantes

- Execute os comandos no **Ubuntu/WSL**, não no PowerShell.
- Trabalhe no filesystem Linux, por exemplo: `~/projetos/...`.
- Evite rodar o projeto em `/mnt/c/...`.
- O container `composer` pode ser usado para instalar dependências quando necessário.
- O Laravel está dentro da pasta `src`.