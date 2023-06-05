<?php

namespace App\Controllers;

use App\Repositories\GameRepository;
use App\Repositories\PlaylistRepository;
use App\Repositories\UserRepository;

class PlayController
{
    public function __construct(
        private PlaylistRepository $playlistRepository = new PlaylistRepository(),
        private UserRepository     $userRepository = new UserRepository(),
        private GameRepository     $gameRepository = new GameRepository(),
    )
    {
    }


    public function index()
    {
        $user = $_SESSION["user"];
        $playlists = $this->playlistRepository->findPlayablePlaylist($user->id());
        require_once __DIR__ . '/../Views/Play/index.php';
    }

    public function show($id)
    {
        $game = $this->gameRepository->find($id);
        $step = $game->step();
        $musics = $this->playlistRepository->findMusics($game->playlistId());
        if (isset($musics[$step])) {
            $music = $musics[$step];
            require_once __DIR__ . '/../Views/Play/game.php';

        }

        return 'fin de partie';
    }

    public function getNextMusic()
    {
        $game = $this->gameRepository->find($_POST["game_id"]);
        $step = $game->step();

        $this->gameRepository->updateUserScore($_POST["game_id"], $_POST["user_id"]);

        $step++;
        $this->gameRepository->update($_POST["game_id"], ["step" => $step]);
    }
}
