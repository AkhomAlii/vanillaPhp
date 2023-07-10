<?php

namespace Core;

class ValidationException extends \Exception
{

    public readonly array $errors;
    public readonly array $attributes;
    public static function throw(array $errors, array $attributes)
    {
        $instance = new static('We Got a Problem!');

        $instance->errors = $errors;
        $instance->attributes = $attributes;

        throw $instance;

    }
}