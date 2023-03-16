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
        if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
            header('Location: /register');
        }

        // Username and email must be unique in database
        try {
            $this->userRepository->create($_POST);
        } catch (\PDOException $e) {
            // Send error message to front : username or email already exists
        }

        header('Location: /login');
    }
}
