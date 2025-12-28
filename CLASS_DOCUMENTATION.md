# Class Documentation

This document provides comprehensive documentation for all classes in the ZapNote application.

---

## Core Classes

### `core\App`

The main application class that manages the dependency injection container.

**Namespace:** `core`

**Properties:**
- `public static $container` - The dependency injection container instance

**Methods:**

#### `setContainer($container): void`
Sets the application container.
- **Parameters:**
  - `$container` - The Container instance to set
- **Returns:** `void`

#### `container()`
Gets the current container instance.
- **Returns:** Container instance

#### `bind($key, $value): void`
Binds a key to a resolver function in the container.
- **Parameters:**
  - `$key` - The key to bind (typically a class name)
  - `$value` - The resolver function (callable)
- **Returns:** `void`

#### `resolve($key)`
Resolves a key from the container, instantiating the bound class.
- **Parameters:**
  - `$key` - The key to resolve (typically a class name)
- **Returns:** The resolved instance
- **Throws:** `Exception` if the key is not found in the container

**Usage Example:**
```php
App::setContainer($container);
$database = App::resolve(Database::class);
```

---

### `core\Container`

A simple dependency injection container that manages class bindings and resolution.

**Namespace:** `core`

**Properties:**
- `protected array $bindings` - Array storing key-value bindings

**Methods:**

#### `bind($key, $value): void`
Binds a key to a resolver function.
- **Parameters:**
  - `$key` - The key to bind
  - `$value` - The resolver function (callable) that returns an instance
- **Returns:** `void`

#### `resolve($key)`
Resolves a key by calling its bound resolver function.
- **Parameters:**
  - `$key` - The key to resolve
- **Returns:** The result of calling the resolver function, or `null` if key is empty
- **Throws:** `Exception` if the key is not found in bindings

**Usage Example:**
```php
$container = new Container();
$container->bind(Database::class, function() {
    $config = require basePath('config/dbConfig.php');
    return new Database($config['database']);
});
$db = $container->resolve(Database::class);
```

---

### `core\Router`

Handles HTTP routing, matching requests to controllers and methods.

**Namespace:** `core`

**Properties:**
- `protected array $routes` - Array of registered routes

**Methods:**

#### `addRoute($method, $uri, $controller): void`
Adds a route to the routing table.
- **Parameters:**
  - `$method` - HTTP method (GET, POST, DELETE, PATCH)
  - `$uri` - URI pattern to match
  - `$controller` - Controller and method in format "Controller@method"
- **Returns:** `void`

#### `get(string $uri, $controller): void`
Registers a GET route.
- **Parameters:**
  - `$uri` - URI pattern
  - `$controller` - Controller and method (e.g., "HomeController@index")
- **Returns:** `void`

#### `post(string $uri, $controller): void`
Registers a POST route.
- **Parameters:**
  - `$uri` - URI pattern
  - `$controller` - Controller and method
- **Returns:** `void`

#### `delete(string $uri, $controller): void`
Registers a DELETE route.
- **Parameters:**
  - `$uri` - URI pattern
  - `$controller` - Controller and method
- **Returns:** `void`

#### `patch(string $uri, $controller): void`
Registers a PATCH route.
- **Parameters:**
  - `$uri` - URI pattern
  - `$controller` - Controller and method
- **Returns:** `void`

#### `callController(array $route): void`
Instantiates and calls the controller method for a matched route.
- **Parameters:**
  - `$route` - Route array containing method, uri, controller, and controllerMethod
- **Returns:** `void`
- **Throws:** `Exception` if controller file, class, or method doesn't exist

#### `route(string $method, string $uri): void`
Routes a request to the appropriate controller based on method and URI.
- **Parameters:**
  - `$method` - HTTP method (GET, POST, etc.)
  - `$uri` - Request URI
- **Returns:** `void`
- **Throws:** `Exception` if no matching route is found

#### `abort(int $code = Response::NOT_FOUND, string $message = ""): void`
Aborts the request with an HTTP error code and displays an error view.
- **Parameters:**
  - `$code` - HTTP status code (default: 404)
  - `$message` - Optional error message
- **Returns:** `void` (never returns, calls exit())

**Usage Example:**
```php
$router = new Router();
$router->get('/', 'HomeController@index');
$router->get('/notes', 'NoteController@index');
$router->route('GET', '/notes');
```

---

### `core\Response`

Contains HTTP response status code constants.

**Namespace:** `core`

**Constants:**
- `NOT_FOUND = 404` - HTTP 404 Not Found status code
- `FORBIDDEN = 403` - HTTP 403 Forbidden status code

**Usage Example:**
```php
http_response_code(Response::NOT_FOUND);
```

---

### `core\database\Database`

Database abstraction layer using PDO for MySQL database operations.

**Namespace:** `core\database`

**Properties:**
- `protected $connection` - PDO connection instance
- `protected $statement` - PDO statement instance

**Methods:**

#### `__construct($config)`
Initializes the database connection.
- **Parameters:**
  - `$config` - Array containing database configuration:
    - `host` - Database host
    - `port` - Database port
    - `username` - Database username
    - `password` - Database password
    - `dbname` - Database name
    - `charset` - Character set (default: utf8mb4)

#### `query($query, $params = [])`
Prepares and executes a SQL query.
- **Parameters:**
  - `$query` - SQL query string
  - `$params` - Optional array of parameters for prepared statement
- **Returns:** `$this` (for method chaining)

#### `find()`
Fetches a single row from the executed query.
- **Returns:** Associative array of the first row, or `false` if no rows

#### `findOrFail()`
Fetches a single row or aborts with 403 error if not found.
- **Returns:** Associative array of the first row
- **Throws:** Aborts with 403 error if no row is found

#### `get()`
Fetches all rows from the executed query.
- **Returns:** Array of associative arrays containing all rows

#### `abort($code = Response::FORBIDDEN, $message = '')`
Private method that aborts execution with an error view.
- **Parameters:**
  - `$code` - HTTP status code (default: 403)
  - `$message` - Error message
- **Returns:** `void` (never returns, calls exit())

**Usage Example:**
```php
$db = new Database($config);
$users = $db->query('SELECT * FROM users WHERE active = ?', [1])->get();
$user = $db->query('SELECT * FROM users WHERE id = ?', [1])->find();
```

---

## Controller Classes

### `app\controllers\Controller`

Base controller class that provides database access to all controllers.

**Namespace:** `app\controllers`

**Properties:**
- `protected $db` - Database instance

**Methods:**

#### `__construct()`
Initializes the controller and resolves the Database instance from the container.
- **Returns:** `void`

**Usage:**
All controllers should extend this class to get database access:
```php
class MyController extends Controller
{
    public function index()
    {
        $data = $this->db->query('SELECT * FROM table')->get();
    }
}
```

---

### `app\controllers\HomeController`

Controller for the home page.

**Namespace:** `app\controllers`

**Methods:**

#### `index(): void`
Displays the home page view.
- **Returns:** `void` (never returns, calls view() which exits)

**Usage:**
Registered in routes as: `$router->get('/', 'HomeController@index');`

---

### `app\controllers\NoteController`

Controller for managing notes.

**Namespace:** `app\controllers`

**Extends:** `Controller`

**Methods:**

#### `__construct()`
Calls parent constructor to initialize database connection.
- **Returns:** `void`

#### `index(): void`
Displays the notes index page with all notes.
- **Returns:** `void` (never returns, calls view() which exits)

#### `findAll()`
Retrieves all notes from the database.
- **Returns:** Array of associative arrays containing all notes

**Usage:**
```php
// In routes
$router->get('/notes', 'NoteController@index');

// The index method automatically fetches and displays all notes
```

---

## Class Hierarchy

```
core\App
core\Container
core\Router
core\Response
core\database\Database

app\controllers\Controller
  ├── app\controllers\HomeController
  └── app\controllers\NoteController
```

---

## Dependency Flow

1. **Bootstrap** (`bootstrap.php`) creates a `Container` and binds `Database`
2. **App** class stores the container statically
3. **Controller** base class resolves `Database` from `App` container
4. **Router** instantiates controllers and calls their methods
5. Controllers use `$this->db` to query the database
6. Controllers call `view()` to render templates

---

## Notes

- All controllers that extend `Controller` automatically have access to `$this->db`
- The `Database` class uses PDO with exception mode enabled
- All database results are returned as associative arrays
- The Router uses a simple array-based routing table
- Error handling is done through the `abort()` method which renders error views


