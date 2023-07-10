<?php


namespace Core;


use Core\Middlewares\Middleware;
use function is_array;
use const false;
use const true;

class Router {


    private static $routes = [];

    /***
     * @param $uri
     * Where you wanna go,
     * @param $action
     * How much you wanna risk
     * @return void
     *
     *
     */

    protected static function append($method, $path, $action): void
    {
        self::$routes[$method][$path] = $action;
    }

    public static function get($path, $action): static
    {
       self::append('GET', $path, $action);
       return new static ;
    }

    public static function post($path, $action): static
    {
        self::append('POST', $path, $action);
       return new static;
    }

    public static function delete($path, $action): static
    {
        self::append('DELETE', $path, $action);
        return new static;
    }

    public static function patch($path, $action): static
    {
        self::append('PATCH', $path, $action);
       return new static;
    }

    public static function route()
    {

        $method = Request::method();
        $middleware = !is_array(Router::$routes[$method][Request::path()]) ?
            false
            : Router::$routes[$method][Request::path()][1];
        if ($middleware){
            Middleware::resolve($middleware);
        }
        return self::getRoute($method, $middleware);
    }


    private static function getRoute($method, $middleware = false)
    {
        return !isset(self::$routes[$method][Request::path()]) ? abort() : self::getAction($method, $middleware);
    }




    private static function getAction(mixed $method, $middleware = false)
    {

        return !$middleware ?
            require base_path('Http/controllers/' . self::$routes[$method][Request::path()])
            : require base_path('Http/controllers/' . self::$routes[$method][Request::path()][0]);
    }





    public static function middleware( $middleware): void
    {
        $method = array_key_last(self::$routes);
        $path = array_key_last(self::$routes[array_key_last(self::$routes)]);

        // I know it sounds creepy but, it basically means:
        // self::$routes['GET']['/'] = [$oldAction, $middleware]

        self::$routes[$method][$path] = [self::$routes[$method][$path], $middleware];
    }
}
