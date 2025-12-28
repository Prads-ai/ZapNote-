<?php

namespace core;

/**
 * HTTP Response status code constants.
 * 
 * This class provides commonly used HTTP status code constants
 * for use throughout the application, making the code more readable
 * and maintainable.
 * 
 * @package core
 */
class Response
{
    /**
     * HTTP 404 Not Found status code.
     * 
     * Used when a requested resource cannot be found.
     */
    const NOT_FOUND = 404;
    
    /**
     * HTTP 403 Forbidden status code.
     * 
     * Used when access to a resource is forbidden.
     */
    const FORBIDDEN = 403;
}