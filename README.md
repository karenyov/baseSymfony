# Base Symfony
================
Este projeto é uma base de estrutura para aplicações utilizando o Framework Symfony 2.8 e Doctrine.

## Requisitos
* Composer
* MySQL

## Início
Para subir o servidor do projeto basta acessar o diretório do projeto através do Prompt de Comando e digitar:
```
$ php app/console server:run
```
Logo teremos como resposta:
```
$ Server running on http://127.0.0.1:8000
```
Abra o navegador e acesse a url: http://127.0.0.1:8000.

Para inserir as tabelas no banco através do Doctrine:
```
$ php app/console doctrine:schema:create
```

##Funcionalidades
* CRUD de usuário