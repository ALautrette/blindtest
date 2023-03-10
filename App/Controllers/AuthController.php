<?php

namespace App\Controllers;

use App\Connector;
use App\Models\User;
use App\Repositories\UserRepository;

class AuthController
{
    public function __construct(
        private UserRepository $userRepository = new UserRepository()
    )
    {
    }

    public function create()
    {
        require_once __DIR__ . '/../Views/Auth/register.php';
    }

    public function store()
    {
        var_dump($this->userRepository->findByUsername('robinator'));
        die();
        // Username, email and password cannot be empty
        if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
            header('Location: /register');
        }
        // Username and email must be unique in database
        if ($this->userRepository->findByUsername($_POST['username'])
            || $this->userRepository->findByEmail($_POST['email'])) {
            header('Location: /register');
        }

        // If all is good, create the user
        $this->userRepository->create($_POST);

        header('Location: /login');
    }
}
