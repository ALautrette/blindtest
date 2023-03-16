<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use PDOException;

class UserController
{
    public function __construct(
        private UserRepository $userRepository = new UserRepository(),
    ) {
    }


    public function index()
    {
        $users = $this->userRepository->findAll();
        require_once __DIR__ . '/../Views/User/index.php';
    }

    public function createForm()
    {
        require_once __DIR__ . '/../Views/User/create.php';
    }

    public function create()
    {
        try {
            $this->userRepository->create([
                "username" => $_POST["username"],
                "email" => $_POST["email"],
                "password" => crypt($_POST["password"], "salt"),
                "is_admin" => isset($_POST["is_admin"]) ? 1 : 0,
            ]);
            $success = "Utilisateur créé avec succès";
            require_once __DIR__ . '/../Views/Components/alert-success.php';
            $this->createForm();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            require_once __DIR__ . '/../Views/Components/alert-error.php';
            $this->createForm();
        }
    }
}
