<?php


namespace Core;


use Core\Middlewares\Middleware;

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

    public static function route(): void
    {
        $method = $_POST['_method'] ?? false;
        $middleware = $method ? self::setMiddleware($method) : self::setMiddleware(Request::method());
        self::routeMiddleware($middleware, $method);
    }

    private static function setMiddleware($method)
    {
        return is_array(self::$routes[$method][Request::path()]) ?
            self::$routes[$method][Request::path()][1] : false;
    }

    private static function routeMiddleware(mixed $middleware, mixed $method): void
    {
        $haveMethod = $_SERVER['REQUEST_METHOD'] === 'POST' && $method !== false;

        if ($middleware) {

            Middleware::resolve($middleware);
            self::shit($haveMethod, $method, true);

        }
        self::shit($haveMethod, $method);

    }




    private static function shit($haveMethod, $method, $middleware = false)
    {
        return isset(self::$routes[Request::method()][Request::path()])
            ? (!$haveMethod ? ((self::getRoute(Request::method(), $middleware)))
            : self::getRoute($method, $middleware)) : (!$haveMethod ? ((abort())) : self::getRoute($method, $middleware));

    }


    private static function getRoute(mixed $method, $middleware = false)
    {
        return $middleware ? require base_path('Http/controllers/' . self::$routes[$method][Request::path()][0])
            : require base_path('Http/controllers/' . self::$routes[$method][Request::path()]);
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
