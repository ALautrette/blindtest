<?php

namespace App\Controllers;

use App\Models\User;
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
        $user = User::getCurrentUser();
        if ($user->isAdmin()) {
            $users = $this->userRepository->findAll();
        } else {
            $users = [$user];
        }

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

    public function delete($id): void
    {
        try {
            $this->userRepository->delete($id);
            $success = "Utilisateur supprimé avec succès";
            require_once __DIR__ . '/../Views/Components/alert-success.php';
            $this->index();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            require_once __DIR__ . '/../Views/Components/alert-error.php';
            $this->index();
        }
    }

    public function updateForm($id)
    {
        $user = $this->userRepository->find($id);
        require_once __DIR__ . '/../Views/User/update.php';
    }

    public function update($id)
    {
        try {
            $this->userRepository->update($id, [
                "username" => $_POST["username"],
                "email" => $_POST["email"],
                "is_admin" => isset($_POST["is_admin"]) ? 1 : 0,
            ]);
            $success = "Utilisateur modifié avec succès";
            require_once __DIR__ . '/../Views/Components/alert-success.php';
            $this->index();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            require_once __DIR__ . '/../Views/Components/alert-error.php';
            $this->updateForm($id);
        }
    }

    public function show()
    {
        $user = User::getCurrentUser();
        require_once __DIR__ . '/../Views/User/show.php';
    }
}
