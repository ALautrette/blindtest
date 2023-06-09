<?php

namespace App\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;

class TestController
{
    public function show()
    {
        echo 'Mon controller <br>';

        // Create user test
        $userrepo = new UserRepository();
        $count = count($userrepo->findAll());
        $userId = $userrepo->create([
            'username' => 'test username',
            'email' => 'email@gmail.com',
            'password' => 'password'
        ])->id();
        if ($count + 1 === count($userrepo->findAll())) {
            echo 'A user can be created successfully';
        } else {
            echo 'There is a problem with the creation of a user';
        }

        // Update user test
        $userrepo->update($userId, [
            'username' => 'new username',
            'email' => 'new@email.com',
            'password' => 'new password'
        ]);

        $user = $userrepo->find($userId);

        if (
            $user->username() === 'new username'
            && $user->email() === 'new@email.com'
            && $user->password() === 'new password'
        ) {
            echo '<br>A user can be updated successfully';
        } else {
            echo '<br>There is a problem with the update of a user';
        }
    }
    public function acces($id)
    {
        echo 'mon id est ' . $id;
    }

    public function auth()
    {
        echo 'methode auth';
    }

    public function testGetUser()
    {
        var_dump(User::getCurrentUser());
    }

    public function sendMail()
    {
        $to = 'test@test.fr';
        $subject = 'Reset your password';
        $message = "Please copy/paste the link below to reset your password:\r\n";
        $message .= $_SERVER['SERVER_NAME'] . "/newpassword?token=testtoken\r\n";
        $headers = "From: reset@spaghetti.agency\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        echo mail($to, $subject, $message, $headers);
    }
}
