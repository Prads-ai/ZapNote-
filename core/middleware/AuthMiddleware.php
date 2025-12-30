<?php

namespace core\middleware;

use core\Session;
use core\middleware\Middleware;

/**
 * Authentication middleware.
 * 
 * Ensures that only authenticated users can access protected routes.
 * Redirects unauthenticated users to the login page.
 * 
 * @package core\middleware
 */
class AuthMiddleware implements Middleware
{
    /**
     * Checks if user is authenticated.
     * 
     * Verifies that a user session exists. If not, redirects to login
     * page with an error message.
     * 
     * @return void
     */
    public function handle(): void
    {
        $userId = Session::get('user_id');
        
        if (!$userId) {
            Session::flash('errors', ['auth' => 'Please login to access this page']);
            redirect('/login');
        }
    }
}

