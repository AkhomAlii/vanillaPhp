<?php

namespace Core;

class Request
{
    public static function method(){
        return self::_post() ? self::_post() : $_SERVER['REQUEST_METHOD'];
    }

    public static function path(): string{
        return parse_url($_SERVER['REQUEST_URI'])['path'];
    }

    private static function _post()
    {
            return $_POST['_method'] ?? false;
    }
}