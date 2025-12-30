<?php

namespace core\middleware;

/**
 * Base middleware interface.
 * 
 * All middleware classes must implement this interface.
 * Middleware is executed before the controller method is called.
 * 
 * @package core\middleware
 */
interface Middleware
{
    /**
     * Handles the middleware logic.
     * 
     * This method is called before the controller method executes.
     * If the middleware needs to stop the request, it should call
     * redirect() or abort() and return early.
     * 
     * @return void
     */
    public function handle(): void;
}

