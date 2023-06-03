# Comandos interessantes

- Mudar a versão do php no linux:
`update-alternatives --config php`

- Para gerar as chaves da aplicação:
`php artisan key:generate`

- Criar Model
`php artisan make:model NomeModel`

- Criar Controller
`php artisan make:controller NomeController`

- Criar Resource
`php artisan make:resource NomeResource`

- Criar Request
`php artisan make:request NomeRequest`

## Comandos de Banco de Dados

- CREATE DATABASE FlexRentall;
- USE FlexRentall;

- Criar chaves do passport
`php artisan passport:install`

- Rodar Migration
`php artisan migrate`

- Rollback Migration
`php artisan migrate:rollback`

- Criar Migration
`php artisan make:migration nome-tabela_table`

- Editar Migration
`php artisan make:migration update_nome_tabela --table=nome`
