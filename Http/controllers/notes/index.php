<?php

use Core\App;
use Core\Database;

$head = 'My Notes';

$pdo = App::resolve(Database::class);
$notes = $pdo->query('select * from notes where user_id = :id',[
    'id' => $_SESSION['user_id']
])->all();


view('notes/index.view.php', [
    'head' => $head,
    'notes' => $notes
]);