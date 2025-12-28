<?php

namespace core;

/**
 * Simple dependency injection container.
 * 
 * This container manages class bindings and their resolution. It allows
 * classes to be bound to resolver functions, which are called when the
 * class needs to be instantiated. This enables dependency injection
 * and makes the code more testable and maintainable.
 * 
 * @package core
 */
class Container
{
    /**
     * Array storing key-value bindings.
     * 
     * Keys are typically class names, and values are callable functions
     * that return instances of those classes.
     * 
     * @var array<string, callable>
     */
    protected array $bindings = [];
    
    /**
     * Binds a key to a resolver function.
     * 
     * The resolver function will be called when resolve() is called with
     * the same key. This allows for lazy instantiation of dependencies.
     * 
     * @param string $key The key to bind (typically a class name)
     * @param callable $value The resolver function that returns an instance
     * @return void
     */
    public function bind($key,$value): void
    {
        $this->bindings[$key] = $value;
    }

    /**
     * Resolves a key by calling its bound resolver function.
     * 
     * If the key is empty, returns null. If the key is not found in
     * bindings, throws an exception.
     * 
     * @param string $key The key to resolve
     * @return mixed The result of calling the resolver function, or null if key is empty
     * @throws \Exception If the key is not found in bindings
     */
    public function resolve($key){
        // Return null if key is empty
        if(!$key){
            return null;
        }
        
        // Check if key exists in bindings
        if(!array_key_exists($key,$this->bindings)){
            throw new \Exception('key "'.$key.'" not found');
        }
        
        // Get the resolver function and call it
        $resolve  = $this->bindings[$key];
        return call_user_func($resolve);
    }
}