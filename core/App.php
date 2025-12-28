<?php

namespace core;

/**
 * Application class that manages the dependency injection container.
 * 
 * This class provides a static interface to the dependency injection container,
 * allowing classes throughout the application to resolve dependencies without
 * directly instantiating the Container class.
 * 
 * @package core
 */
class App
{
    /**
     * The dependency injection container instance.
     * 
     * @var Container|null
     */
    public static $container;
    
    /**
     * Sets the application's dependency injection container.
     * 
     * This should be called during application bootstrap to initialize
     * the container with all necessary bindings.
     * 
     * @param Container $container The container instance to use
     * @return void
     */
    public static function setContainer($container): void
    {
        self::$container = $container;
    }
    
    /**
     * Gets the current container instance.
     * 
     * @return Container|null The container instance, or null if not set
     */
    public function container(){
        return self::$container;
    }
    
    /**
     * Binds a key to a resolver function in the container.
     * 
     * This is a convenience method that delegates to the container's bind method.
     * 
     * @param string $key The key to bind (typically a class name)
     * @param callable $value The resolver function that returns an instance
     * @return void
     */
    public static function bind($key,$value): void
    {
        self::$container->bind($key,$value);
    }
    
    /**
     * Resolves a key from the container, instantiating the bound class.
     * 
     * This is a convenience method that delegates to the container's resolve method.
     * 
     * @param string $key The key to resolve (typically a class name)
     * @return mixed The resolved instance
     * @throws \Exception If the key is not found in the container
     */
    public static function resolve($key){
        return self::$container->resolve($key);
    }
}