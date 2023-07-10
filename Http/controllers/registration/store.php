<?php


use Core\App;
use Core\Database;
use Core\Validator;

$errors = [];
$email = $_POST['email'];
$password = $_POST['password'];


if (! Validator::email($email)){
    $errors['email'] = 'A valid email must be provided';

//    return view('registration/create.view.php', [
//        'errors' => $errors,
//        'email' => $email,
//        'password' => $password
//    ]);
//    die();
}

if (! Validator::string($password, 8)){
    $errors['password'] = 'A password must not be less than 8 chars';
//    return view('registration/create.view.php', [
//        'errors' => $errors,
//        'email' => $email,
//        'password' => $password
//    ]);
//    die();
}


$pdo = App::resolve(Database::class);
$user = $pdo->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user){
    $errors['email'] = 'This one\' already registered' ;

//    return view('registration/create.view.php', [
//        'errors' => $errors,
//        'email' => $email,
//        'password' => $password
//    ]);
//    die();
}

if (! empty($errors)){
    return view('registration/create.view.php', [
    'errors' => $errors,
    'email' => $email,
    'password' => $password
    ]);
    die();
}

$pdo->query('insert into users(email, password) values (:email, :password)', [
    'email' => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT)
]);


$_SESSION['user_id'] = $pdo->query('select id from users where email = :email', [
        'email' => $email
])->find()['id'];

$_SESSION['email'] = $email ;

header('Location: /');
exit();