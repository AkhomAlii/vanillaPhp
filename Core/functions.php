<?php

function didu(...$something ){

    echo '<pre>';
    var_dump($something);
    echo '</pre>';
    die();
}

function urlIs($url){
    return $_SERVER['REQUEST_URI'] === $url;

}

function abort($code = 404)
{
    http_response_code($code);

    view("{$code}.php");

    die();
}


function authenticate($condition)
{
    if (! $condition ){
        abort(Core\Response::FORBIDDEN);
    }
}

function base_path($path){
    return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $path;
}

function view ($path, $data = []){
    extract($data);
   return require base_path('views/' . $path) ;
}

function redirect($path){
     header("Location: {$path}");
     exit();
}

function back()
{
    return redirect($_SERVER['HTTP_REFERER']);
}