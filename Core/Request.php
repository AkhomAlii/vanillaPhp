<?php

namespace Core;

class Request
{
    public static function method(){
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public static function path(): string{
        return parse_url($_SERVER['REQUEST_URI'])['path'];
    }
}