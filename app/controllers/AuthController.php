<?php

namespace app\controllers;

use core\Session;
use core\Validate;
use JetBrains\PhpStorm\NoReturn;

/**
 * Authentication controller for user login and registration.
 * 
 * Handles user authentication, registration, and session management.
 * 
 * @package app\controllers
 */
class AuthController extends Controller
{
    /**
     * Displays the login form.
     * 
     * Shows the login page with any error messages from previous attempts.
     * 
     * @return void Never returns (calls view() which exits)
     */
    #[NoReturn]
    public function showLogin(): void
    {
        // Retrieve flash messages and pass to view
        $errors = Session::get('errors', []);
        view('auth/login', ['errors' => $errors]);
    }

    /**
     * Processes user login.
     * 
     * Validates credentials and creates a session if successful.
     * Redirects to notes page on success, back to login on failure.
     * 
     * @return void
     */
    public function login(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validate input
        $errors = [];
        if (empty($email)) {
            $errors['email'] = 'Email is required';
        } elseif (!Validate::email($email)) {
            $errors['email'] = 'Please enter a valid email address';
        }

        if (empty($password)) {
            $errors['password'] = 'Password is required';
        }

        if (!empty($errors)) {
            Session::flash('errors', $errors);
            redirect('/login');
            return;
        }

        // Find user by email
        $user = $this->db->query(
            'SELECT * FROM users WHERE email = :email',
            [':email' => $email]
        )->find();

        // Verify password
        if (!$user || !password_verify($password, $user['password'] ?? '')) {
            Session::flash('errors', ['login' => 'Invalid email or password']);
            redirect('/login');
            return;
        }

        // Create session
        Session::put('user_id', $user['userId']);
        Session::put('user_name', $user['name'] ?? $user['email']);

        // Redirect to notes
        redirect('/notes');
    }

    /**
     * Displays the registration form.
     * 
     * Shows the registration page with any error messages from previous attempts.
     * 
     * @return void Never returns (calls view() which exits)
     */
    #[NoReturn]
    public function showRegister(): void
    {
        // Retrieve flash messages and pass to view
        $errors = Session::get('errors', []);
        view('auth/register', ['errors' => $errors]);
    }

    /**
     * Processes user registration.
     * 
     * Validates input, checks for existing user, creates new user account.
     * Redirects to login on success, back to register on failure.
     * 
     * @return void
     */
    public function register(): void
    {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        // Validate input
        $errors = [];

        if (empty($name)) {
            $errors['name'] = 'Name is required';
        } elseif (!Validate::string($name, 2, 100)) {
            $errors['name'] = 'Name must be between 2 and 100 characters';
        }

        if (empty($email)) {
            $errors['email'] = 'Email is required';
        } elseif (!Validate::email($email)) {
            $errors['email'] = 'Please enter a valid email address';
        }

        if (empty($password)) {
            $errors['password'] = 'Password is required';
        } elseif (!Validate::string($password, 6, 255)) {
            $errors['password'] = 'Password must be at least 6 characters';
        }

        if ($password !== $passwordConfirm) {
            $errors['password_confirm'] = 'Passwords do not match';
        }

        if (!empty($errors)) {
            Session::flash('errors', $errors);
            redirect('/register');
            return;
        }

        // Check if user already exists
        $existingUser = $this->db->query(
            'SELECT userId FROM users WHERE email = :email',
            [':email' => $email]
        )->find();

        if ($existingUser) {
            Session::flash('errors', ['email' => 'Email already registered']);
            redirect('/register');
            return;
        }

        // Create new user
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $this->db->query(
                'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)',
                [
                    ':name' => $name,
                    ':email' => $email,
                    ':password' => $hashedPassword
                ]
            );

            // Redirect to login with success message
            Session::flash('success', 'Registration successful! Please login.');
            redirect('/login');
        } catch (\Exception $e) {
            Session::flash('errors', ['database' => 'Registration failed. Please try again.']);
            redirect('/register');
        }
    }

    /**
     * Logs out the current user.
     * 
     * Destroys the session and redirects to home page.
     * 
     * @return void Never returns (calls redirect() which exits)
     */
    #[NoReturn]
    public function logout(): void
    {
        Session::destroy();
        redirect('/');
    }
}

