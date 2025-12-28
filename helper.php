<?php

use JetBrains\PhpStorm\NoReturn;

const BASE_PATH = __DIR__;

/**
 * Generates an absolute file path by appending the given path to the base directory.
 * 
 * This function is used to create file paths relative to the project root directory.
 * It ensures consistent path resolution across the application.
 * 
 * @param string $path The relative path to append to the base directory (e.g., 'app/controllers/home.php')
 * @return string The absolute file path (e.g., '/path/to/project/app/controllers/home.php')
 * 
 * @example
 * $controllerPath = basePath('app/controllers/home.php');
 * // Returns: '/var/www/project/app/controllers/home.php'
 */
function basePath(string $path): string
{
    return BASE_PATH .'/'. $path;
}

/**
 * Renders a view file and terminates script execution.
 * 
 * This function loads and displays a view template from the resources/views directory.
 * The view file should have a .view.php extension. Any data passed will be extracted
 * as variables available in the view template. After rendering, the script execution stops.
 * 
 * @param string $path The view name without the .view.php extension (e.g., 'home' for 'home.view.php')
 * @param array $data Optional associative array of data to pass to the view as variables
 * @return void This function never returns as it calls exit() after rendering
 * 
 * @example
 * // Render a simple view
 * view('home');
 * 
 * // Render a view with data
 * view('user', ['name' => 'John', 'email' => 'john@example.com']);
 * // In the view, $name and $email will be available
 */
#[NoReturn]
function view(string $path, array $data=[]): void
{
    $viewPath = basePath("resources/views/{$path}.view.php");
    if(!file_exists($viewPath)) {
        echo "View $path not found";
        exit();
    }
    extract($data);
    require $viewPath;
    exit();
}

/**
 * Includes a partial view file without terminating script execution.
 * 
 * Partials are reusable components that can be included within other views.
 * Unlike the view() function, this does not stop script execution, allowing
 * multiple partials to be included in a single page. The partial file should
 * be located in resources/views/partials/ with a .php extension.
 * 
 * @param string $path The partial name without the .php extension (e.g., 'head' for 'head.php')
 * @param array $data Optional associative array of data to pass to the partial as variables
 * @return void
 * 
 * @example
 * // Include a partial in a view
 * <?php partial('head') ?>
 * 
 * // Include a partial with data
 * <?php partial('user-card', ['name' => 'John', 'role' => 'Admin']) ?>
 * // In the partial, $name and $role will be available
 */
function partial(string $path, array $data=[]): void
{
    $viewPath = basePath("resources/views/partials/{$path}.php");
    if(!file_exists($viewPath)) {
        echo "View $path not found";
        return;
    }
    extract($data);
    require $viewPath;
}

/**
 * Dump and die - displays variable information and terminates script execution.
 * 
 * This is a debugging utility function that outputs the structure and value
 * of a variable in a formatted way, then stops script execution. Useful for
 * debugging during development.
 * 
 * @param mixed $data The variable to dump (can be any type: string, array, object, etc.)
 * @return void This function never returns as it calls die() after dumping
 * 
 * @example
 * $user = ['name' => 'John', 'age' => 30];
 * dd($user);
 * // Outputs formatted var_dump and stops execution
 */
#[NoReturn]
function dd($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}
