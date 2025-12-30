<?php

namespace core;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use core\Response;

/**
 * HTTP Router class that handles request routing to controllers.
 * 
 * This router manages HTTP routes and maps them to controller methods.
 * It supports GET, POST, DELETE, and PATCH HTTP methods and provides
 * error handling for missing routes and controllers.
 * 
 * @package core
 */
class Router
{
    /**
     * Array of registered routes.
     * 
     * Each route contains:
     * - method: HTTP method (GET, POST, DELETE, PATCH)
     * - uri: URI pattern to match
     * - controller: Controller class name (without namespace)
     * - controllerMethod: Method name to call on the controller
     * - middleware: Optional array of middleware class names
     * 
     * @var array<int, array{method: string, uri: string, controller: string, controllerMethod: string, middleware?: array<string>}>
     */
    protected array $routes = [];
    
    /**
     * Adds a route to the routing table.
     * 
     * Parses the controller string (format: "Controller@method") and
     * stores the route information in the routes array.
     * 
     * @param string $method The HTTP method (GET, POST, DELETE, PATCH)
     * @param string $uri The URI pattern to match
     * @param string $controller The controller and method in format "Controller@method"
     * @param array<string>|null $middleware Optional array of middleware class names
     * @return void
     */
    public function addRoute($method, $uri, $controller, $middleware = null): void
    {
        // Parse controller string (e.g., "HomeController@index")
        [$controller, $controllerMethod] = explode('@', $controller);
        
        // Store route information
        $route = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
        ];
        
        // Add middleware if provided
        if ($middleware !== null) {
            $route['middleware'] = $middleware;
        }
        
        $this->routes[] = $route;
    }
    
    /**
     * Registers a GET route.
     * 
     * @param string $uri The URI pattern
     * @param string $controller Controller and method (e.g., "HomeController@index")
     * @param array<string>|null $middleware Optional array of middleware class names
     * @return void
     */
    public function get(string $uri, $controller, $middleware = null): void
    {
        $this->addRoute('GET', $uri, $controller, $middleware);
    }
    
    /**
     * Registers a POST route.
     * 
     * @param string $uri The URI pattern
     * @param string $controller Controller and method (e.g., "NoteController@store")
     * @param array<string>|null $middleware Optional array of middleware class names
     * @return void
     */
    public function post(string $uri, $controller, $middleware = null): void
    {
        $this->addRoute('POST', $uri, $controller, $middleware);
    }
    
    /**
     * Registers a DELETE route.
     * 
     * @param string $uri The URI pattern
     * @param string $controller Controller and method (e.g., "NoteController@destroy")
     * @param array<string>|null $middleware Optional array of middleware class names
     * @return void
     */
    public function delete(string $uri, $controller, $middleware = null): void
    {
        $this->addRoute('DELETE', $uri, $controller, $middleware);
    }
    
    /**
     * Registers a PATCH route.
     * 
     * @param string $uri The URI pattern
     * @param string $controller Controller and method (e.g., "NoteController@update")
     * @param array<string>|null $middleware Optional array of middleware class names
     * @return void
     */
    public function patch(string $uri, $controller, $middleware = null): void
    {
        $this->addRoute('PATCH', $uri, $controller, $middleware);
    }

    /**
     * Executes middleware for a route.
     * 
     * Runs all middleware associated with the route before the controller is called.
     * Middleware classes must be in the `core\middleware` namespace and implement
     * the `Middleware` interface. If any middleware redirects or aborts, execution stops.
     * 
     * @param array<string> $middleware Array of middleware class names (without namespace)
     * @return void
     * @throws Exception If middleware class is not found
     * 
     * @example
     * // Middleware is automatically run when route is matched
     * $router->get('/notes', 'NoteController@index', ['AuthMiddleware']);
     * // AuthMiddleware will run before NoteController@index is called
     */
    protected function runMiddleware(array $middleware): void
    {
        foreach ($middleware as $middlewareClass) {
            // Build fully qualified middleware class name
            $fullClassName = "core\\middleware\\" . $middlewareClass;
            
            // Check if middleware class exists
            if (!class_exists($fullClassName)) {
                throw new Exception("Middleware class not found: {$fullClassName}");
            }
            
            // Instantiate and run middleware
            $middlewareInstance = new $fullClassName();
            $middlewareInstance->handle();
        }
    }

    /**
     * Instantiates and calls the controller method for a matched route.
     * 
     * This method loads the controller file, instantiates the controller class,
     * and calls the specified method. It performs validation to ensure the
     * controller file, class, and method all exist. Runs middleware before
     * calling the controller method.
     * 
     * @param array{method: string, uri: string, controller: string, controllerMethod: string, middleware?: array<string>} $route The route array
     * @return void
     * @throws Exception If controller file, class, or method doesn't exist
     */
    public function callController(array $route): void
    {
        // Run middleware first if any exists
        if (isset($route['middleware']) && !empty($route['middleware'])) {
            $this->runMiddleware($route['middleware']);
        }
        
        // Build controller file path
        $controllerFile = basePath("app/controllers/" . $route['controller'] . ".php");
        
        // Check if controller file exists
        if (!file_exists($controllerFile)) {
            $this->abort(Response::NOT_FOUND, "Controller file not found: {$route['controller']}.php");
        }
        
        // Load the controller file
        require $controllerFile;
        
        // Build fully qualified class name
        $controllerName = "app\\controllers\\" . $route['controller'];
        $method = $route['controllerMethod'];

        // Check if controller class exists
        if(!class_exists($controllerName)){
            $this->abort(Response::NOT_FOUND, "Controller class not found: {$controllerName}");
        }
        
        // Instantiate the controller
        $instance = new $controllerName();

        // Check if method exists in controller
        if(!method_exists($instance, $method)){
            throw new Exception("Method " . $method . " does not exist for the class " . $controllerName);
        }
        
        // Call the controller method
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