<?php

namespace App\Controllers;

use App\Repositories\GameRepository;
use App\Repositories\PlaylistRepository;
use App\Repositories\UserRepository;
use PDOException;

class PlayController
{
    public function __construct(
        private PlaylistRepository $playlistRepository = new PlaylistRepository(),
        private UserRepository $userRepository = new UserRepository(),
    ) {
    }


    public function index()
    {
        $user = $_SESSION["user"];
        $playlists = $this->playlistRepository->findPlayablePlaylist($user->id());
        require_once __DIR__ . '/../Views/Play/index.php';
    }


}
