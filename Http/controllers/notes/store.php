<?php

use Core\App;
use Core\Database;
use Core\Validator;

$pdo = App::resolve(Database::class);
$errors = [];


    if (! Validator::string($_POST['body'])){
        $errors['body'] = 'A note body should be => 1 < body < 500 ';
    }

     if (! empty($errors)){
         view('notes/create.view.php', [
            'head' => 'Create a Note',
            'errors' => $errors
        ]);
         die();
     }

        $pdo->query('insert into notes(body, user_id) values(:body, :user_id)', [
            'body' => htmlspecialchars($_POST['body']),
            'user_id' => $_SESSION['user_id']
        ]);
     header('Location: /notes');
     die();


