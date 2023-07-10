<?php

namespace Core;

class Authenticator
{

    public function attempt($email, $password){
        $user = App::resolve(Database::class)->query('select * from users where email = :email', [
            'email' => $email
        ])->find();

        if ($user){
            if (password_verify($password, $user['password'])){
                $this->login($user);
                return true;
            }
        }
        return false;
    }

    private function login($user)
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        session_regenerate_id(true);
    }
}