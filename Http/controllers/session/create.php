<?php

return view('session/create.view.php', [
    'errors' => \Core\Session::get('errors'),
    'email' => \Core\Session::get('email') ?? ''
]);