<?php

use core\Router;
use Exception;

require "../helper.php";
spl_autoload_register(function ($class) {
    $class = str_replace("\\", "/", $class);
    $classPath = basePath("{$class}.php");
    if (!file_exists($classPath)) {
        echo "The class \"{$class}\" does not exist.\n";
        return;
    }
    require $classPath;
});

$router = new Router();
require basePath("/routes/webRoutes.php");
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($method, $uri);
} catch (Exception $e) {
    http_response_code(500);
    echo "<h1>Error</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}