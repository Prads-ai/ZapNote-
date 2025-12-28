<?php

namespace core\database;

use core\Response;
use PDO;

/**
 * Database abstraction layer using PDO.
 * 
 * This class provides a simple, fluent interface for database operations
 * using PDO. It handles MySQL database connections and provides methods
 * for querying and fetching data. All results are returned as associative arrays.
 * 
 * @package core\database
 */
class Database
{
    /**
     * PDO database connection instance.
     * 
     * @var PDO
     */
    protected $connection;
    
    /**
     * PDO statement instance for prepared queries.
     * 
     * @var \PDOStatement|null
     */
    protected $statement;
    
    /**
     * Initializes the database connection.
     * 
     * Creates a PDO connection using the provided configuration array.
     * Sets error mode to exception and default fetch mode to associative array.
     * 
     * @param array{host: string, port: int, username: string, password: string, dbname: string, charset: string} $config Database configuration array
     * @throws \PDOException If connection fails
     */
    public function __construct($config){
        // Build DSN string from config array
        $dsn = 'mysql:'.http_build_query($config,'',';');
        
        // Set PDO options
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Return associative arrays
        ];
        
        // Create PDO connection
        $this->connection = new PDO($dsn,$config['username'],$config['password'],$options);
    }
    
    /**
     * Prepares and executes a SQL query.
     * 
     * This method prepares a SQL statement with optional parameters and executes it.
     * Returns $this to allow method chaining with find(), findOrFail(), or get().
     * 
     * @param string $query SQL query string (can contain placeholders)
     * @param array $params Optional array of parameters for prepared statement
     * @return $this Returns self for method chaining
     * @throws \PDOException If query preparation or execution fails
     */
    public function query($query,$params = []){
        // Prepare the SQL statement
        $this->statement = $this->connection->prepare($query);
        
        // Execute with parameters
        $this->statement->execute($params);
        
        // Return self for method chaining
        return $this;
    }
    
    /**
     * Fetches a single row from the executed query.
     * 
     * Returns the first row as an associative array, or false if no rows are found.
     * 
     * @return array|false Associative array of the first row, or false if no rows
     */
    public function find(){
        return $this->statement->fetch();
    }
    
    /**
     * Fetches a single row or aborts with error if not found.
     * 
     * Similar to find(), but aborts execution with a 403 error if no row is found.
     * Useful when a record must exist for the application to continue.
     * 
     * @return array Associative array of the first row
     * @throws void Never returns if no row found (calls abort which exits)
     */
    public function findOrFail(){
        $result = $this->statement->fetch();
        
        // Abort if no result found
        if(!$result){
            $this->abort();
        }
        
        return $result;
    }
    
    /**
     * Fetches all rows from the executed query.
     * 
     * Returns all rows as an array of associative arrays.
     * 
     * @return array<int, array> Array of associative arrays containing all rows
     */
    public function get(){
        return $this->statement->fetchAll();
    }

    /**
     * Aborts execution with an HTTP error code and displays an error view.
     * 
     * This is a private method used internally when database operations fail
     * or when required records are not found. It sets the HTTP response code
     * and renders an error view, then exits the script.
     * 
     * @param int $code HTTP status code (default: 403 Forbidden)
     * @param string $message Optional error message to display
     * @return void Never returns (calls exit())
     */
    private function abort($code = Response::FORBIDDEN,$message = '')
    {
        // Set HTTP response code
        http_response_code($code);
        
        // Render error view
        view('error/webError',[
            'code' => $code,
            'message' => $message,
        ]);
        
        // Exit script execution
        exit();
    }
}