<?php

use Core\App;
use Core\Database;

$pdo = App::resolve(Database::class);

$note = $pdo->query('select * from notes where id = :id', ['id' => $_GET['id']])->findOrFail();


authenticate($note['user_id'] === $_SESSION['user_id']);

view('notes/show.view.php', [
    'head' => 'My Notes',
    'note' => $note
    ]);

