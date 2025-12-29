<?php

namespace core;

class Validate
{
    public static function string($string,$min=1,$max=INF): bool
    {
        return strlen($string) >= $min && strlen($string) <= $max;
    }
    /**
     * Sanitizes input data for safe storage and display.
     * 
     * This function trims whitespace and escapes HTML entities for safe output.
     * Note: For database storage, use prepared statements instead of this function.
     * This function is primarily for sanitizing output to prevent XSS attacks.
     * 
     * @param mixed $data The data to sanitize (will be converted to string)
     * @return string The sanitized string, or empty string if input is invalid
     */
    public static function sanitize($data)
    {
        // Handle null or non-string types
        if ($data === null) {
            return '';
        }
        
        // Convert to string if not already
        if (!is_string($data)) {
            $data = (string) $data;
        }
        
        // Trim whitespace
        $data = trim($data);
        
        // Escape HTML entities with UTF-8 encoding and ENT_QUOTES flag
        // ENT_QUOTES escapes both single and double quotes
        return htmlentities($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
    public static function email($email): bool{
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    public static function isGreater($value1,$greaterThan): bool
    {
        return $value1 > $greaterThan;
    }
}