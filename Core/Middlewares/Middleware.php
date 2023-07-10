<?php

namespace Core\Middlewares;
use Core\Request;

abstract class  Middleware
{
    public const MAPPER =[
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    public static function resolve($middleware)
    {
        $middleware = Middleware::MAPPER[$middleware] ?? false;

        if (! $middleware){
            return;
        }
        return (new $middleware)->handle();
    }

    abstract public function handle();




}