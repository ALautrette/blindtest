<?php

namespace App\Controllers;

use App\Repositories\UserRepository;

class UserController
{
    public function index()
    {
        $userRepository = new UserRepository();
        $users = $userRepository->findAll();
        require_once __DIR__ . '/../Views/User/index.php';
    }
}