<?php

namespace App\Controllers;

use App\Connector;
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
}