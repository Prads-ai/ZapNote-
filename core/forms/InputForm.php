<?php

namespace core\forms;

use core\Validate;

class InputForm
{
    protected array $errors = [];
    protected array $fields = [];
    public function validate($data = []): bool
    {
        $allowedFields = ['title','body'];
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

    public function errors(): array
    {
        return $this->errors;
    }
    
    public function fields(): array
    {
        return $this->fields;
    }
    
    public function error($key,$value): void
    {
        $this->errors[$key] = $value;
    }
}