<?php

namespace Core;
class Validator
{

    //Validator::string($value, min = 1, max = 500)
    public static function string($value, $min = 1, $max = 500)
    {

        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email(mixed $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

}