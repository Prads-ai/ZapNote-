<?php

namespace core\forms;

use core\Validate;

/**
 * Form validation and data filtering class for note input.
 * 
 * This class handles validation, sanitization, and filtering of form input data
 * for note creation. It ensures only allowed fields are processed and validates
 * them according to specified rules.
 * 
 * @package core\forms
 * 
 * @example
 * // Basic usage
 * $form = new InputForm();
 * if ($form->validate($_POST)) {
 *     $data = $form->fields(); // Get sanitized, filtered data
 *     // Save to database
 * } else {
 *     $errors = $form->errors(); // Get validation errors
 *     // Display errors to user
 * }
 */
class InputForm
{
    /**
     * Array of validation errors.
     * 
     * Keys are field names, values are error messages.
     * 
     * @var array<string, string>
     */
    protected array $errors = [];
    
    /**
     * Filtered and sanitized form fields.
     * 
     * Contains only the allowed fields from the input data after filtering.
     * 
     * @var array<string, string>
     */
    protected array $fields = [];
    
    /**
     * Validates and filters form input data.
     * 
     * This method:
     * 1. Filters input to only include allowed fields ('title', 'body')
     * 2. Checks for missing required fields
     * 3. Validates field length (5-200 characters)
     * 4. Sanitizes field values
     * 
     * Validation rules:
     * - All fields are required
     * - Minimum length: 5 characters
     * - Maximum length: 200 characters
     * 
     * @param array<string, mixed> $data The raw form data (typically $_POST)
     * @return bool True if validation passes (no errors), false otherwise
     * 
     * @example
     * $form = new InputForm();
     * if ($form->validate($_POST)) {
     *     // Validation successful
     *     $cleanData = $form->fields();
     * } else {
     *     // Validation failed
     *     $errors = $form->errors();
     * }
     */
    public function validate($data = []): bool
    {
        // Define allowed fields that can be processed
        $allowedFields = ['title','body'];
        
        // Filter data to only include allowed fields
        $this->fields = array_intersect_key($data, array_flip($allowedFields));
        
        // Check for missing required fields
        foreach ($allowedFields as $field) {
            if (!isset($this->fields[$field]) || empty(trim($this->fields[$field] ?? ''))) {
                $this->errors[$field] = ucfirst($field) . " is required and must be between 5 and 200 characters";
            }
        }
        
        // Validate the filtered fields that exist
        foreach ($this->fields as $key => $value) {
            if (isset($this->errors[$key])) {
                continue; // Skip if already marked as missing
            }
            $sanitized = Validate::sanitize($value);
            if (empty($sanitized) || !Validate::string($sanitized, 5, 200)) {
                $this->errors[$key] = ucfirst($key) . " is required and must be between 5 and 200 characters";
            }
        }

        return empty($this->errors);
    }

    /**
     * Returns all validation errors.
     * 
     * Returns an associative array where keys are field names and values
     * are error messages. Returns an empty array if there are no errors.
     * 
     * @return array<string, string> Associative array of field names => error messages
     * 
     * @example
     * $errors = $form->errors();
     * // Returns: ['title' => 'Title is required...', 'body' => 'Body is required...']
     * 
     * foreach ($errors as $field => $message) {
     *     echo "$field: $message";
     * }
     */
    public function errors(): array
    {
        return $this->errors;
    }
    
    /**
     * Returns the filtered and sanitized form fields.
     * 
     * Returns only the allowed fields that passed validation.
     * Fields are sanitized and ready for database insertion.
     * 
     * @return array<string, string> Associative array of field names => sanitized values
     * 
     * @example
     * $data = $form->fields();
     * // Returns: ['title' => 'My Note Title', 'body' => 'Note content...']
     * 
     * // Use for database insertion
     * $db->query('INSERT INTO notes (title, body) VALUES (:title, :body)', $data);
     */
    public function fields(): array
    {
        return $this->fields;
    }
    
    /**
     * Manually adds an error for a specific field.
     * 
     * Useful for adding custom validation errors or errors from
     * external validation logic.
     * 
     * @param string $key The field name
     * @param string $value The error message
     * @return void
     * 
     * @example
     * $form->error('title', 'Title must be unique');
     * $form->error('body', 'Body contains invalid characters');
     */
    public function error($key,$value): void
    {
        $this->errors[$key] = $value;
    }
}