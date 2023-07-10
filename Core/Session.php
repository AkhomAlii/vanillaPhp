<?php

namespace Core;

class Session
{

    public static function flash($key, $value)
    {
        $_SESSION['_flashed'][$key] = $value;
    }

    public static function flush()
    {
        unset($_SESSION['_flashed']);
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        return $_SESSION['_flashed'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function unset($key, $value)
    {
        unset($_SESSION[$key]);
    }

    public static function destroy()
    {
        $_SESSION = [];

        session_destroy();
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }


}