<?php

namespace App\Controllers;

use App\Repositories\GameRepository;
use App\Repositories\TagRepository;
use App\Repositories\PlaylistRepository;

class GameController
{
    public function __construct(
        private GameRepository $gameRepository = new GameRepository(),
    ) {
    }


    public function index()
    {
        $games = $this->gameRepository->findAll();
        require_once __DIR__ . '/../Views/Game/index.php';
    }

    public function createForm()
    {
        require_once __DIR__ . '/../Views/Game/create.php';
    }

    public function create()
    {
        //
    }
}
