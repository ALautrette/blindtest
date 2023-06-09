<?php

namespace App\Controllers;

use App\Repositories\TagRepository;
use PDOException;

class TagController
{
    public function __construct(
        private TagRepository $tagRepository = new TagRepository(),
    ) {
    }


    public function index()
    {
        $tags = $this->tagRepository->findAll();
        require_once __DIR__ . '/../Views/Tag/index.php';
    }

    public function createForm()
    {
        require_once __DIR__ . '/../Views/Tag/create.php';
    }

    public function create()
    {
        try {
            $this->tagRepository->create([
                "name" => $_POST["name"],
            ]);
            $success = "Tag créé avec succès";
            require_once __DIR__ . '/../Views/Components/alert-success.php';
            $this->index();
        } catch (PDOException $e) {
            $code = $e->getCode();
            if($code == 23000) {
                $error = "Le tag existe déjà";
            } else {
                $code = $e->getMessage();
            }
            require_once __DIR__ . '/../Views/Components/alert-error.php';
            $this->createForm();
        }
    }

    public function delete($id): void
    {
        try {
            $this->tagRepository->delete($id);
            $success = "Tag supprimé avec succès";
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
        $tag = $this->tagRepository->find($id);
        require_once __DIR__ . '/../Views/Tag/update.php';
    }

    public function update($id)
    {
        try {
            $this->tagRepository->update($id, [
                "name" => $_POST["name"],
            ]);
            $success = "Tag modifié avec succès";
            require_once __DIR__ . '/../Views/Components/alert-success.php';
            $this->index();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            require_once __DIR__ . '/../Views/Components/alert-error.php';
            $this->updateForm($id);
        }
    }
}
