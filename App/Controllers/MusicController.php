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
        //
    }
}
