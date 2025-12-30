<?php

namespace core;

class Session
{
    public static function put($key,$value): void
    {
        $_SESSION[$key] = $value;
    }
    public static function get($key,$default = null){
        // Check flash messages first
        if (isset($_SESSION['_flash'][$key])) {
            $value = $_SESSION['_flash'][$key];
            // Mark for deletion (will be cleared at end of request)
            $_SESSION['_flash'][$key] = null;
            return $value;
        }
        // Fall back to regular session
        return $_SESSION[$key] ?? $default;
    }
    public static function has($key): bool
    {
        // Check flash messages first without marking for deletion
        if (isset($_SESSION['_flash'][$key]) && $_SESSION['_flash'][$key] !== null) {
            return true;
        }
        // Fall back to regular session
        return isset($_SESSION[$key]);
    }
    public static function flash($key,$value = null): void
    {
        $_SESSION['_flash'][$key] = $value;
    }
    /**
     * Clears flash messages that were marked for deletion.
     * Should be called at the end of each request.
     */
    public static function clearFlash(): void
    {
        if (isset($_SESSION['_flash'])) {
            foreach ($_SESSION['_flash'] as $key => $value) {
                if ($value === null) {
                    unset($_SESSION['_flash'][$key]);
                }
            }
            // Remove _flash array if empty
            if (empty($_SESSION['_flash'])) {
                unset($_SESSION['_flash']);
            }
        }
    }
    
    public static function flush(): void{
        $_SESSION = [];
    }
    public static function destroy(): void{
        session_destroy();
        Session::flush();
        $params = session_get_cookie_params();
        setcookie(session_name(),"",time() - 42000,$params['path'],$params['domain'],$params['secure'],$params['httponly']);
    }
}