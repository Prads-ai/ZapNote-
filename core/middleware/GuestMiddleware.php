<?php

namespace core\middleware;

use core\Session;
use core\middleware\Middleware;

/**
 * Guest middleware.
 * 
 * Ensures that only unauthenticated users (guests) can access certain routes.
 * Redirects authenticated users away from guest-only pages (like login/register).
 * 
 * @package core\middleware
 */
class GuestMiddleware implements Middleware
{
    /**
     * Checks if user is a guest (not authenticated).
     * 
     * Verifies that no user session exists. If a user is logged in,
     * redirects them to the notes page.
     * 
     * @return void
     */
    public function handle(): void
    {
        $userId = Session::get('user_id');
        
        if ($userId) {
            redirect('/notes');
        }
    }
}

