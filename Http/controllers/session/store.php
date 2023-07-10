<?php


use Core\Authenticator;
use Http\Forms\LoginForm;


$formValidator = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);
$signedIn = (new Authenticator)
    ->attempt($attributes['email'], $attributes['password']);
if ( $signedIn){
    redirect('/');
}

$formValidator->error('email', 'No matching found for this combination')->throw();
