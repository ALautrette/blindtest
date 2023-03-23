<?php

namespace App\Controllers;

use App\Repositories\PlaylistRepository;

class PlaylistController
{
    public function __construct(
        private PlaylistRepository $playlistRepository = new PlaylistRepository(),
    ) {
    }


    public function index()
    {
        $playlists = $this->playlistRepository->findAll();
        require_once __DIR__ . '/../Views/Playlist/index.php';
    }

    public function createForm()
    {
        require_once __DIR__ . '/../Views/Playlist/create.php';
    }

    public function create()
    {
        //
    }
}
