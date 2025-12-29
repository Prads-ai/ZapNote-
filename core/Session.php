<?php

namespace core;

class Session
{
    public static function put($key,$value): void
    {
        $_SESSION[$key] = $value;
    }
    public static function get($key,$default = null){
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }
    public static function has($key): bool
    {
        return static::get($key) !== null;
    }
    public static function flash($key,$value = null): void
    {
        $_SESSION['_flash'][$key] = $value;
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