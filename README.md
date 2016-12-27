# Base Symfony
Este projeto é uma base de estrutura para aplicações utilizando o Framework Symfony 2.8 e Doctrine.

## Requisitos
* [MySQL](https://www.mysql.com/)
* [Composer](https://getcomposer.org/)
* [Node.js](https://nodejs.org/en/)

## Configuração inicial
```
#Instalando composer
$ composer install

#Instalando bower
$ npm install -g bower
```
```
#Criando schema
$ php app/console doctrine:database:create
$ php app/console doctrine:schema:create
```

## Subindo a aplicação
Para subir o servidor do projeto basta acessar o diretório do projeto através do Prompt de Comando e digitar:
```
$ php app/console server:run
```
Logo teremos como resposta:
```
$ Server running on http://127.0.0.1:8000
```
Abra o navegador e acesse a url: http://127.0.0.1:8000.

##Características
* Gerenciamento de dependências front-end com [Bower](https://bower.io/).
* Utilização de biblioteca para Enum: [FreshDoctrineEnumBundle](https://github.com/fre5h/DoctrineEnumBundle).
* Utilização do [Knp Paginator](https://github.com/KnpLabs/KnpPaginatorBundle).
* Utilização do [FOSUserBundle](https://github.com/FriendsOfSymfony/FOSUserBundle) para autenticação de usuários.