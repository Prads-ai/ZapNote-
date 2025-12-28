<?php

use core\App;
use core\Container;
use core\database\Database;

$container = new Container();
$container->bind(Database::class,function(){
    $config = require basePath('config/dbConfig.php');
    return new Database($config['database']);
});

$container->resolve(Database::class);
App::setContainer($container);