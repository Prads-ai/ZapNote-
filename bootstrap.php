<?php

use core\App;
use core\Container;
use core\database\Database;

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$container = new Container();
$container->bind(Database::class,function(){
    $config = require basePath('config/dbConfig.php');
    return new Database($config['database']);
});

$container->resolve(Database::class);
App::setContainer($container);

// Register shutdown function to clear flash messages
register_shutdown_function(function() {
    if (session_status() === PHP_SESSION_ACTIVE) {
        \core\Session::clearFlash();
    }
});