# Levantamento Inicial do Banco de Dados — Confeitaria DaVilla

Antes de começar o desenvolvimento da API, fiz um levantamento para entender quais informações já existem no sistema.

A API será responsável por buscar e gravar dados no banco. Portanto, antes de criar rotas, controllers ou autenticação, precisamos responder perguntas como:

- Quais tabelas existem?
- Onde estão os clientes?
- Onde estão os produtos?
- Como um produto está ligado a uma categoria?
- Onde os pedidos são registrados?
- Como os itens de um pedido estão relacionados aos produtos?

O objetivo/ideia desta etapa é construir um **mapa do banco de dados**.

## 1. Verificar se os containers estão funcionando

Valide os containers: docker compose ps

Precisamos ter pelo: mysql, php e nginx com Up

## 2. Descobrir quais tabelas existem

Na raiz do projeto execute o comando:

docker compose exec mysql \
mysql -uuser -puser davilla -e "
SHOW TABLES;
"

O comando possui algumas partes: 
docker compose exec mysql: Significa: execute um comando dentro do container chamado `mysql`.
mysql -uuser -puser davilla: Significa: 
       -uuser     usuário do banco
       -puser     senha do banco
       davilla    banco que queremos consultar

SHOW TABLES: Significa: mostre todas as tabelas existentes no banco `davilla`.


## 3. Resultado encontrado

cache
cache_locks
failed_jobs
job_batches
jobs
migrations
password_reset_tokens
sessions

tbl_banner
tbl_categoria
tbl_clientes
tbl_contato
tbl_controle_materia_prima
tbl_fornecedores
tbl_itens_venda
tbl_materia_prima
tbl_produtos
tbl_usuarios
tbl_vendas

users

### Tabelas relacionadas ao Laravel

       cache
       cache_locks
       failed_jobs
       job_batches
       jobs
       migrations
       password_reset_tokens
       sessions
       users

São tabelas utilizadas ou criadas pela estrutura padrão do Laravel.

### Tabelas do negócio da Confeitaria DaVilla

       tbl_banner
       tbl_categoria
       tbl_clientes
       tbl_contato
       tbl_controle_materia_prima
       tbl_fornecedores
       tbl_itens_venda
       tbl_materia_prima
       tbl_produtos
       tbl_usuarios
       tbl_vendas

Tabelas que representam o funcionamento da confeitaria.


## 4. Investigar a estrutura das tabelas

DESCRIBE nome_da_tabela;

Fiz o levantamento das seguintes tabelas:

docker compose exec mysql \
mysql -uuser -puser davilla -e "
DESCRIBE tbl_clientes;
DESCRIBE tbl_categoria;
DESCRIBE tbl_produtos;
DESCRIBE tbl_vendas;
DESCRIBE tbl_itens_venda;
DESCRIBE tbl_banner;
"
O MySQL apresenta colunas como:

Field: nome do campo
Type: tipo de dado armazenado
Null: se o campo pode ficar vazio
Key: tipo de chave ou índice
Default: valor utilizado automaticamente
Extra: comportamentos adicionais

mysql: [Warning] Using a password on the command line interface can be insecure.
+-----------------------+--------------+------+-----+-------------------+-----------------------------------------------+
| Field                 | Type         | Null | Key | Default           | Extra                                         |
+-----------------------+--------------+------+-----+-------------------+-----------------------------------------------+
| id_cliente            | int          | NO   | PRI | NULL              | auto_increment                                |
| nome_cliente          | varchar(50)  | NO   |     | NULL              |                                               |
| tipo_cliente          | varchar(2)   | NO   |     | NULL              |                                               |
| cpf_cnpj_cliente      | varchar(18)  | NO   | UNI | NULL              |                                               |
| data_nasc_cliente     | date         | NO   |     | NULL              |                                               |
| endereco_cliente      | varchar(40)  | NO   |     | NULL              |                                               |
| numero_cliente        | varchar(6)   | NO   |     | NULL              |                                               |
| complemento_cliente   | varchar(50)  | YES  |     | NULL              |                                               |
| bairro_cliente        | varchar(40)  | NO   |     | NULL              |                                               |
| cidade_cliente        | varchar(40)  | NO   |     | NULL              |                                               |
| uf_cliente            | varchar(2)   | NO   |     | NULL              |                                               |
| cep_cliente           | varchar(9)   | NO   |     | NULL              |                                               |
| email_cliente         | varchar(80)  | NO   | UNI | NULL              |                                               |
| senha_cliente         | varchar(255) | NO   |     | NULL              |                                               |
| telefone_cliente      | varchar(14)  | NO   |     | NULL              |                                               |
| foto_cliente          | varchar(60)  | NO   |     | NULL              |                                               |
| status_cliente        | varchar(10)  | NO   |     | ATIVO             |                                               |
| criado_em_cliente     | datetime     | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED                             |
| atualizado_em_cliente | datetime     | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED on update CURRENT_TIMESTAMP |
+-----------------------+--------------+------+-----+-------------------+-----------------------------------------------+
+-------------------------+-------------+------+-----+-------------------+-----------------------------------------------+
| Field                   | Type        | Null | Key | Default           | Extra                                         |
+-------------------------+-------------+------+-----+-------------------+-----------------------------------------------+
| id_categoria            | int         | NO   | PRI | NULL              | auto_increment                                |
| nome_categoria          | varchar(30) | NO   |     | NULL              |                                               |
| descricao_categoria     | text        | NO   |     | NULL              |                                               |
| status_categoria        | varchar(10) | NO   |     | ATIVO             |                                               |
| criado_em_categoria     | datetime    | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED                             |
| atualizado_em_categoria | datetime    | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED on update CURRENT_TIMESTAMP |
+-------------------------+-------------+------+-----+-------------------+-----------------------------------------------+
+-----------------------+--------------+------+-----+-------------------+-----------------------------------------------+
| Field                 | Type         | Null | Key | Default           | Extra                                         |
+-----------------------+--------------+------+-----+-------------------+-----------------------------------------------+
| id_produto            | int          | NO   | PRI | NULL              | auto_increment                                |
| nome_produto          | varchar(30)  | NO   |     | NULL              |                                               |
| slug_produto          | varchar(150) | YES  |     | NULL              |                                               |
| id_categoria          | int          | NO   | MUL | NULL              |                                               |
| descricao_produto     | text         | NO   |     | NULL              |                                               |
| tamanho_produto       | varchar(10)  | NO   |     | NULL              |                                               |
| unid_med_produto      | varchar(2)   | NO   |     | NULL              |                                               |
| valor_produto         | double(10,2) | NO   |     | NULL              |                                               |
| foto_produto          | varchar(60)  | NO   |     | NULL              |                                               |
| status_produto        | varchar(10)  | NO   |     | ATIVO             |                                               |
| destaque_produto      | varchar(3)   | NO   |     | NAO               |                                               |
| criado_em_produto     | datetime     | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED                             |
| atualizado_em_produto | datetime     | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED on update CURRENT_TIMESTAMP |
+-----------------------+--------------+------+-----+-------------------+-----------------------------------------------+
+---------------------+--------------+------+-----+-------------------+-----------------------------------------------+
| Field               | Type         | Null | Key | Default           | Extra                                         |
+---------------------+--------------+------+-----+-------------------+-----------------------------------------------+
| id_venda            | int          | NO   | PRI | NULL              | auto_increment                                |
| id_cliente          | int          | NO   | MUL | NULL              |                                               |
| id_usuario          | int          | NO   | MUL | NULL              |                                               |
| data_venda          | datetime     | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED                             |
| valor_venda         | double(10,2) | NO   |     | NULL              |                                               |
| status_venda        | varchar(12)  | NO   |     | NULL              |                                               |
| data_entrega_venda  | datetime     | NO   |     | NULL              |                                               |
| atualizado_em_venda | datetime     | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED on update CURRENT_TIMESTAMP |
+---------------------+--------------+------+-----+-------------------+-----------------------------------------------+
+--------------------+--------------+------+-----+-------------------+-----------------------------------------------+
| Field              | Type         | Null | Key | Default           | Extra                                         |
+--------------------+--------------+------+-----+-------------------+-----------------------------------------------+
| id_item            | int          | NO   | PRI | NULL              | auto_increment                                |
| id_venda           | int          | NO   | MUL | NULL              |                                               |
| id_produto         | int          | NO   | MUL | NULL              |                                               |
| valor_unit_item    | double(10,2) | NO   |     | NULL              |                                               |
| qtde_item          | double(10,2) | NO   |     | NULL              |                                               |
| status_item        | varchar(10)  | NO   |     | NULL              |                                               |
| atualizado_em_item | datetime     | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED on update CURRENT_TIMESTAMP |
+--------------------+--------------+------+-----+-------------------+-----------------------------------------------+
+--------------------+--------------+------+-----+---------+----------------+
| Field              | Type         | Null | Key | Default | Extra          |
+--------------------+--------------+------+-----+---------+----------------+
| id_banner          | int          | NO   | PRI | NULL    | auto_increment |
| nome_banner        | varchar(30)  | NO   |     | NULL    |                |
| titulo_banner      | varchar(80)  | NO   |     | NULL    |                |
| subtitulo_banner   | varchar(120) | YES  |     | NULL    |                |
| descricao_banner   | text         | YES  |     | NULL    |                |
| texto_botao_banner | varchar(30)  | YES  |     | NULL    |                |
| link_botao_banner  | varchar(120) | YES  |     | NULL    |                |
| ordem_banner       | int          | NO   |     | 0       |                |
| foto_banner        | varchar(50)  | NO   |     | NULL    |                |
| status_banner      | varchar(10)  | NO   |     | NULL    |                |
+--------------------+--------------+------+-----+---------+----------------+



## 5. Novas necessidades identificadas no banco de dados

Após o levantamento da estrutura atual e a análise das funcionalidades previstas para o aplicativo, identificamos a necessidade de criar novas tabelas e adaptar algumas tabelas existentes. Essas alterações não fazem parte da estrutura original do banco. Elas representam a evolução do banco para atender novas regras de negócio.

Tabela de Favoritos: O cliente poderá marcar produtos como favoritos para encontrá-los novamente com facilidade.

       id_favorito
       id_cliente
       id_produto
       criado_em_favorito
       status_favorito

Tabela de Depoimentos: O cliente poderá enviar um depoimento sobre sua experiência com a confeitaria.

       id_depoimento
       id_cliente
       texto_depoimento
       nota_depoimento (de 1 a 5)
       status_depoimento (pendente de forma automatica)
       criado_em_depoimento
       atualizado_em_depoimento

Tabela de Endereços: Atualmente os dados de endereço estão armazenados diretamente em: tbl_clientes com campos como:

       endereco_cliente
       numero_cliente
       complemento_cliente
       bairro_cliente
       cidade_cliente
       uf_cliente
       cep_cliente

Essa estrutura permite apenas um endereço por cliente. Como o aplicativo deverá permitir vários endereços, será criada uma tabela específica:

tbl_enderecos_cliente

       id_endereco
       id_cliente
       nome_endereco
       endereco
       numero
       complemento
       bairro
       cidade
       uf
       cep
       principal_endereco
       status_endereco
       criado_em_endereco
       atualizado_em_endereco

Tabela de Cupons de Desconto: Será necessário permitir a utilização de cupons durante a realização de um pedido.

       id_cupom
       codigo_cupom
       valor_desconto_cupom
       data_inicio_cupom
       data_fim_cupom
       status_cupom
       criado_em_cupom
       atualizado_em_cupom

Alterações necessárias em tbl_vendas: A tabela tbl_vendas já registra os pedidos realizados, porém precisará receber novas informações para atender o aplicativo.

Estrutura atual principal:

       id_venda
       id_cliente
       id_usuario
       data_venda
       valor_venda
       status_venda
       data_entrega_venda
       atualizado_em_venda

Novos campos:

       id_endereco
       id_cupom
       forma_pagamento_venda
       entrega_venda
       observacao_venda
       valor_desconto_venda

Forma de pagamento, o campo: forma_pagamento_venda poderá registrar informações como:

       PIX
       DINHEIRO
       CARTAO

Entrega, o campo: entrega_venda poderá trabalhar com:

       SIM
       NAO

Quando a entrega_venda = SIM a venda deverá possuir um endereço relacionado:

       tbl_vendas.id_endereco
       tbl_enderecos_cliente.id_endereco

Cupom e desconto, caso o cliente utilize um cupom:

       tbl_vendas.id_cupom
       tbl_cupons.id_cupom

Também é vamos registrar o valor_desconto_venda porque preservamos na venda o valor efetivamente concedido naquele momento.

Mapa da venda:

       Cliente
       │
       ├── possui vários endereços
       ├── favorita vários produtos
       ├── pode enviar depoimentos
       └── realiza pedidos
              │
              ├── possui vários itens
              ├── pode utilizar um cupom
              ├── informa forma de pagamento
              ├── define entrega ou retirada
              └── pode incluir uma observação


Criação das migration:

docker compose exec php php artisan make:migration create_tbl_favoritos_table
docker compose exec php php artisan make:migration create_tbl_enderecos_cliente_table
docker compose exec php php artisan make:migration create_tbl_depoimentos_table
docker compose exec php php artisan make:migration create_tbl_cupons_table
docker compose exec php php artisan make:migration alter_tbl_vendas_for_app


 ls -ls src/database/migrations | tail -n 10
       4 -rw-r--r-- 1 root              root      543 Sep 10 09:05 2026_09_10_120536_create_tbl_favoritos_table.php

 sudo chown -R $USER:www-data src/database/migrations
 find src/database/migrations -type f -exec chmod 664 {} \;


docker compose exec --user "$(id -u):$(id -g)" \
php php artisan make:migration migrate_client_addresses_to_tbl_enderecos_cliente

docker compose exec --user "$(id -u):$(id -g)" \
php php artisan make:migration remove_address_columns_from_tbl_clientes --table=tbl_clientes