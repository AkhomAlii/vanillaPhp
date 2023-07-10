<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{

    private array $errors = [];

    public function __construct(private array $attributes)
    {
        if (! Validator::email($this->attributes['email']))
            $this->errors['email'] = 'A valid email must be provided';

        if (! Validator::string($this->attributes['password'], 8))
            $this->errors['password'] = 'password cannot be less than 8 chars';
    }

    private function attributes(): array
    {
        return $this->attributes;
    }

    public function throw()
    {
        return ValidationException::throw($this->errors(), $this->attributes());
    }

    public static function validate($attributes)
    {
        $instance = new self($attributes);

        return !empty($instance->errors()) ? $instance->throw() : $instance;
    }

    public function error($field, $msg)
    {
        $this->errors[$field] = $msg;
        return $this;
    }

    public function errors(): array
    {
        return $this->errors;
    }


}