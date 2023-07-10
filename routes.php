<?php

use Core\Router;

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];


Router::get('/notes', 'notes/index.php')->middleware('auth');

Router::get('/register', 'registration/create.php')->middleware('guest');

Router::get('/login', 'session/create.php')->middleware('guest');

Router::post('/login', 'session/store.php')->middleware('guest');

Router::delete('/logout', 'session/destroy.php')->middleware('auth');



Router::get('/', 'index.php');
Router::get('/about', 'about.php');
Router::get('/contact', 'contact.php');



Router::get('/note', 'notes/show.php');
Router::delete('/note', 'notes/destroy.php');
Router::get('/note/edit', 'notes/edit.php');
Router::patch('/note', 'notes/update.php');

Router::get('/notes-create', 'notes/create.php');
Router::post('/notes', 'notes/store.php');



Router::post('/register', 'registration/store.php');


