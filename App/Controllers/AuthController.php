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
            $message = 'All fields are required';
            return require_once __DIR__ . '/../Views/Auth/register.php';
        }

        try {
            $_POST['password'] = crypt($_POST['password'], 'salt');
            $user = $this->userRepository->create($_POST);
            session_start();
            $_SESSION['username'] = $user->username();
        } catch (\PDOException $e) {
            $message = $this->getErrorMessage($e);
            return require_once __DIR__ . '/../Views/Auth/register.php';
        }
        return require_once __DIR__ . '/../Views/dashboard.php';
    }

    public function loginPage()
    {
        require_once __DIR__ . '/../Views/Auth/login.php';
    }

    public function login()
    {
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $message = 'All fields are required';
            return require_once __DIR__ . '/../Views/Auth/login.php';
        }

        try {
            $user = $this->userRepository->findByEmail($_POST['email']);
            $user->verifyPassword($_POST['password']);

            session_start();
            $_SESSION['username'] = $user->username();
            return require_once __DIR__ . '/../Views/dashboard.php';
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return require_once __DIR__ . '/../Views/Auth/login.php';
        }
    }

    private function getErrorMessage(\PDOException|\Exception $e): string
    {
        if (str_contains($e->getMessage(), "for key 'username'")) {
            return 'Username already taken';
        }
        if (str_contains($e->getMessage(), "for key 'email'")) {
            return 'An account with this email already exists';
        }
        return 'Something went wrong';
    }
}
