<?php

use Core\Router;

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

Router::get('/', 'index.php');
Router::get('/about', 'about.php');
Router::get('/contact', 'contact.php');

///USER REGISTRATION
Router::get('/register', 'registration/create.php')->middleware('guest');
Router::post('/register', 'registration/store.php')->middleware('guest');
Router::get('/login', 'session/create.php')->middleware('guest');
Router::post('/login', 'session/store.php')->middleware('guest');
Router::delete('/logout', 'session/destroy.php')->middleware('auth');

///NOTES
Router::get('/notes', 'notes/index.php')->middleware('auth');
Router::get('/note', 'notes/show.php')->middleware('auth');
Router::get('/note/edit', 'notes/edit.php')->middleware('auth');
Router::get('/notes-create', 'notes/create.php')->middleware('auth');
Router::post('/notes', 'notes/store.php')->middleware('auth');
Router::patch('/note', 'notes/update.php')->middleware('auth');
Router::delete('/note', 'notes/destroy.php')->middleware('auth');






