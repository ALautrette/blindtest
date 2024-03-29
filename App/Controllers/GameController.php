<?php

namespace App\Controllers;

use App\Repositories\GameRepository;
use App\Repositories\PlaylistRepository;
use App\Repositories\UserRepository;
use PDOException;

class GameController
{
    public function __construct(
        private GameRepository $gameRepository = new GameRepository(),
        private PlaylistRepository $playlistRepository = new PlaylistRepository(),
        private UserRepository $userRepository = new UserRepository(),
    ) {
    }


    public function index()
    {
        $games = $this->gameRepository->findAllWithRelations();
        require_once __DIR__ . '/../Views/Game/index.php';
    }

    public function createForm()
    {
        $playlists = $this->playlistRepository->findAll();
        $users = $this->userRepository->findAll();
        require_once __DIR__ . '/../Views/Game/create.php';
    }

    public function create()
    {
        try {
            $this->gameRepository->create([
                "date" => $_POST["date"],
                "playlist_id" => $_POST["playlist_id"],
                "user_id" => $_POST["user_id"],
            ]);
            $success = "Partie créée avec succès";
            require_once __DIR__ . '/../Views/Components/alert-success.php';
            $this->index();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            require_once __DIR__ . '/../Views/Components/alert-error.php';
            $this->createForm();
        }
    }

    public function delete($id): void
    {
        try {
            $this->gameRepository->delete($id);
            $success = "Partie supprimée avec succès";
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
        $game = $this->gameRepository->find($id);
        $playlists = $this->playlistRepository->findAll();
        $users = $this->userRepository->findAll();
        require_once __DIR__ . '/../Views/Game/update.php';
    }

    public function update($id)
    {
        try {
            $this->gameRepository->update($id, [
                "date" => $_POST["date"],
                "playlist_id" => $_POST["playlist_id"],
                "user_id" => $_POST["user_id"],
            ]);
            $success = "Partie modifiée avec succès";
            require_once __DIR__ . '/../Views/Components/alert-success.php';
            $this->index();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            require_once __DIR__ . '/../Views/Components/alert-error.php';
            $this->updateForm($id);
        }
    }
}
