<?php


use Core\App;
use Core\Database;
use Core\Validator;

$pdo = App::resolve(Database::class);

//retrieve a note
$note = $pdo->query('select * from notes where id = :id', ['id' => $_POST['id']])->findOrFail();



//authenticate the user
authenticate($_SESSION['user_id'] == $note['user_id']);

// check user input
$errors = [];
if (! Validator::string($_POST['body'])){
    $errors['body'] = 'A note body should not be like this';
}

if (! empty($errors)){
    return view('notes/edit.view.php', [
        'head' => 'Edit',
        'note' => $note,
        'errors' => $errors
    ]);
}


$pdo->query('update notes set body = :body where id = :id',[
    'body' => $_POST['body'],
    'id' => $_POST['id']
]);

header('Location: /notes');
die();
//update the note