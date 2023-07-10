<?php

namespace Core;

class App
{

    private static $conatiner;

//    App::bind($something, $somehow);
    public static function setContainer($container){

        self::$conatiner = $container;
    }


//    App::resolve($something);
    public static function getContainer(){

       return self::$conatiner;
    }


    public static function bind($key, $func){
        self::getContainer()->bind($key, $func);
    }

    public static function resolve($key){

        return self::getContainer()->resolve($key);
    }

}