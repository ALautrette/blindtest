<?php

namespace App\Controllers;

use App\Repositories\TagRepository;
use App\Repositories\PlaylistRepository;

class MusicController
{
    public function __construct(
        private TagRepository $musicRepository = new TagRepository(),
    ) {
    }


    public function index()
    {
        $musics = $this->musicRepository->findAll();
        require_once __DIR__ . '/../Views/Music/index.php';
    }

    public function createForm()
    {
        require_once __DIR__ . '/../Views/Music/create.php';
    }

    public function create()
    {
        try {
            $this->musicRepository->create([
                "url" => $_POST["url"],
                "title" => $_POST["title"],
                "artist" => $_POST["artist"],
                "timecode" => $_POST["timecode"],
            ]);
        } catch (PDOException $e) {
            $error = $e->getMessage();
            require_once __DIR__ . '/../Views/Components/alert-error.php';
            $this->createForm();
        }
    }

    public function delete($id): void
    {
        try {
            $this->musicRepository->delete($id);
            $success = "Musique supprimée avec succès";
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
        $music = $this->musicRepository->find($id);
        require_once __DIR__ . '/../Views/Music/update.php';
    }

    public function update($id)
    {
        try {
            $this->musicRepository->update($id, [
                "url" => $_POST["url"],
                "title" => $_POST["title"],
                "artist" => $_POST["artist"],
                "timecode" => $_POST["timecode"],
            ]);
            $success = "Musique modifiée avec succès";
            require_once __DIR__ . '/../Views/Components/alert-success.php';
            $this->index();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            require_once __DIR__ . '/../Views/Components/alert-error.php';
            $this->updateForm($id);
        }
    }
}
