# Contatos
Sistema de cadastro de Pessoas e Endereços feito em Laravel com PHP 7.x e banco SQlite 3. 

Foi escolhido o framework Laravel completo ao invés da sua implementação microframework (Lumen) devido aos utilitários adionais providos para acelerar o desenvolvimento da aplicação.

## Executar sistema

- composer install
- cp .env.example .env
- php artisan key:generate
- touch database/database.sqlite
- php artisan migrate
- php artisan db:seed

### Modelos

O sistema utiliza a implementação de modelos default do Laravel baseada no Eloquent que estão no namespace App/Model.
