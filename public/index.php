<?php

session_start();

use Core\Router;
use Core\Session;
const BASE_PATH = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;

require BASE_PATH . 'vendor/autoload.php';

require BASE_PATH . 'Core/functions.php';



require base_path('bootstrap.php');


require base_path('routes.php');
try {

    Router::route();
} catch (\Core\ValidationException $exception){
    Session::flash('errors', $exception->errors);
    Session::flash('email', htmlspecialchars($exception->attributes['email']));
    back();
}

Session::flush();