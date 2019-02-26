# Contatos
Sistema de cadastro de Pessoas e Endereços feito em Laravel com PHP 7.x e banco SQlite 3. 

Foi escolhido o framework Laravel completo ao invés da sua implementação microframework (Lumen) devido aos utilitários adionais providos para acelerar o desenvolvimento da aplicação.

## Dependências

O ambiente precisa atender as dependências do Laravel versão 5.7: https://laravel.com/docs/5.7#installation

## Executar sistema

Para iniciar o sistema são necessárias as seguintes etapas (os comandos devem ser executados na raiz do projeto)

```
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan db:seed
```

Depois disso é necessário editar o parâmetro DB_DATABASE do arquivo .env na raiz do projeto com o path completo do arquivo database.sqlite

### Executar testes unitários

Os testes unitários são providos pela integração com o PHPUnit do Laravel e podem ser executados com:

```
./vendor/bin/phpunit
```

A implementação dos testes unitários está na pasta /tests nos arquivos PessoaTest.php e EnderecoTest.php

### Documentação da API

Documentação da API gerada com Postman disponível em:
https://documenter.getpostman.com/view/891227/S11Huenq


### Postman

A coleção do Postman usada para testar a API foi exportada para /Contatos.postman_collection.json
