<?php

namespace Core;

class Container
{

    private $box = [];

    public function bind($key, $func){
        $this->box[$key] = $func;
    }

    public function resolve($key){
        if (! array_key_exists($key, $this->box)){
            throw new \Exception("We found NOTHING for {$key}");
        }



        return call_user_func($this->box[$key]);
    }
}