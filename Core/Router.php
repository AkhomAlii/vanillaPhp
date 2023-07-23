<?php


namespace Core;


use Core\Middlewares\Middleware;

class Router {

    private static string $method;
    public static array $routes = [];

    /***
     * @param $method
     * Handled by the caller function
     * @param $path
     * Where do you wanna go,
     * @param $action
     * How much you wanna risk
     *
     *
     */

    protected static function append($method, $path, $action): void
    {
        self::$routes[$method][$path] = $action;
    }

    public static function get($path, $action): static
    {
        static::$method = 'GET';
       self::append('GET', $path, $action);
       return new static ;
    }

    public static function post($path, $action): static
    {
        static::$method = 'POST';
        self::append('POST', $path, $action);
       return new static;
    }

    public static function delete($path, $action): static
    {
        static::$method = 'DELETE';
        self::append('DELETE', $path, $action);
        return new static;
    }

    public static function patch($path, $action): static
    {
        static::$method = 'PATCH';
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
        $path = array_key_last(self::$routes[self::$method]);
        // I know it sounds creepy but, it basically means:
        // self::$routes['GET']['/'] = [$oldAction, $middleware] instead of "$oldAction"
        self::$routes[self::$method][$path] = [self::$routes[self::$method][$path], $middleware];
    }
}
