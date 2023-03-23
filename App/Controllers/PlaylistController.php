<?php

namespace App\Controllers;

use App\Repositories\MusicRepository;
use App\Repositories\PlaylistRepository;
use App\Repositories\TagRepository;
use PDOException;

class PlaylistController
{
    public function __construct(
        private PlaylistRepository $playlistRepository = new PlaylistRepository(),
        private MusicRepository    $musicRepository = new MusicRepository(),
        private TagRepository      $tagRepository = new TagRepository(),
    )
    {
    }


    public function index()
    {
        $playlists = $this->playlistRepository->findAll();
        require_once __DIR__ . '/../Views/Playlist/index.php';
    }

    public function createForm()
    {
        $musics = $this->musicRepository->findAll();
        $tags = $this->tagRepository->findAll();
        require_once __DIR__ . '/../Views/Playlist/create.php';
    }

    public function create()
    {
        try {
            $playlist = $this->playlistRepository->create([
                'name' => $_POST["name"],
                'user_id' => $_SESSION['user']->id(),
                'is_public' => $_POST['is_public'] ? 1 : 0,
            ]);
            foreach ($_POST['musics'] as $music){
                $this->musicRepository->insertMusicPlaylist($music, $playlist->id());
            }
            //A compléter
        } catch (PDOException $e) {
            $error = $e->getMessage();
            require_once __DIR__ . '/../Views/Components/alert-error.php';
            $this->createForm();
        }
    }
}
