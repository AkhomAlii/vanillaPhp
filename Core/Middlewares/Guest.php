<?php

namespace Core\Middlewares;

class Guest extends Middleware
{

    public function handle(){
        if ( $_SESSION['user_id'] ?? false ){
            header('Location: /');
            exit();
        }
    }
}