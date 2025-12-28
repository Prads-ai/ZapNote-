<?php

namespace core;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use core\Response;

class Router
{
    protected array $routes = [];
    
    /**
     * Adds a route to the routing table.
     * 
     * @param string $method The HTTP method (GET, POST, DELETE, PATCH)
     * @param string $uri The URI pattern to match
     * @param string $controller The controller and method in format "Controller@method"
     * @return void
     */
    public function addRoute($method, $uri, $controller): void
    {
        [$controller, $controllerMethod] = explode('@', $controller);
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
        ];
    }
    public function get(string $uri, $controller): void
    {
        $this->addRoute('GET', $uri, $controller);
    }
    public function post(string $uri, $controller): void
    {
        $this->addRoute('POST', $uri, $controller);
    }
    public function delete(string $uri, $controller): void
    {
        $this->addRoute('DELETE', $uri, $controller);
    }
    public function patch(string $uri, $controller): void
    {
        $this->addRoute('PATCH', $uri, $controller);
    }

    /**
     * @throws Exception
     */
    public function callController(array $route): void
    {
        $controllerFile = basePath("app/controllers/" . $route['controller'] . ".php");
        
        // Check if file exists before requiring
        if (!file_exists($controllerFile)) {
            $this->abort(Response::NOT_FOUND, "Controller file not found: {$route['controller']}.php");
        }
        
        require $controllerFile;
        
        $controllerName = "app\\controllers\\" . $route['controller'];
        $method = $route['controllerMethod'];

        if(!class_exists($controllerName)){
            $this->abort(Response::NOT_FOUND, "Controller class not found: {$controllerName}");
        }
        
        $instance = new $controllerName();

        if(!method_exists($instance, $method)){
            throw new Exception("Method " . $method . " does not exist for the class " . $controllerName);
        }
        $instance->$method();
    }

    /**
     * Routes a request to the appropriate controller based on method and URI.
     * 
     * @param string $method The HTTP method (GET, POST, etc.)
     * @param string $uri The request URI
     * @return void
     * @throws Exception If controller file, class, or method is not found
     */
    public function route(string $method, string $uri): void
    {
        foreach($this->routes as $route){
            if($route['method'] === $method && $route['uri'] === $uri){
                $this->callController($route);
                return; // Exit after finding and calling the controller
            }
        }
        // No matching route found
        $this->abort();
    }
    /**
     * Aborts the request with an HTTP error code and displays an error view.
     * 
     * This method sets the HTTP response code and renders an error view.
     * The view() function will terminate script execution after rendering.
     * 
     * @param int $code The HTTP status code (default: 404)
     * @param string $message Optional error message to display
     * @return void This function never returns as view() calls exit()
     */
    #[NoReturn]
    public function abort(int $code = Response::NOT_FOUND, string $message = ""): void
    {
        http_response_code($code);
        view('error/webError', [
            'code' => $code,
            'message' => $message,
        ]);
    }
}