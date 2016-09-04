# A simple slim starter for building flexible php application

The project is based on slim3.x and many excellent php package


## How to install

* $ composer install




## Features


* Database migration based on phinx

Create migration file:
 
$ php vendor/bin/phinx create UserMigration -c src/phinx.php 

Do migration: 

$ php vendor/bin/phinx migrate -c src/phinx.php

* Simple MVC based on twig/illuminate database and MartynBiz controller
* Admin ui based ng-admin
* Simple database user auth has been integrated

More to be continued
