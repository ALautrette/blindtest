<?php

namespace App\Controllers;

use App\Repositories\MusicRepository;
use App\Repositories\PlaylistRepository;
use App\Repositories\TagRepository;
use App\Repositories\UserRepository;
use PDOException;

class PlaylistController
{
    public function __construct(
        private PlaylistRepository $playlistRepository = new PlaylistRepository(),
        private MusicRepository    $musicRepository = new MusicRepository(),
        private TagRepository      $tagRepository = new TagRepository(),
        private UserRepository     $userRepository = new UserRepository(),
    ) {
    }


    public function index(): void
    {
        $playlists = $this->playlistRepository->findAll();
        require_once __DIR__ . '/../Views/Playlist/index.php';
    }

    public function createForm(): void
    {
        $musics = $this->musicRepository->findAll();
        $tags = $this->tagRepository->findAll();
        require_once __DIR__ . '/../Views/Playlist/create.php';
    }

    public function create(): void
    {
        try {
            $playlist = $this->playlistRepository->create([
                'name' => $_POST["name"],
                'user_id' => $_SESSION['user']->id(),
                'is_public' => isset($_POST['is_public']) ? 1 : 0,
            ]);
            foreach ($_POST['musics'] as $music) {
                $this->playlistRepository->insertMusicPlaylist($music, $playlist->id());
            }
            $tags = array_unique($_POST["tags"]);
            foreach ($tags as $tag) {
                $this->playlistRepository->insertTagPlaylist($tag, $playlist->id());
            }
            $success = "Playlist créée avec succès";
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
            $this->playlistRepository->delete($id);
            $success = "Playlist supprimée avec succès";
            require_once __DIR__ . '/../Views/Components/alert-success.php';
            $this->index();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            require_once __DIR__ . '/../Views/Components/alert-error.php';
            $this->index();
        }
    }

    public function show($id): void
    {
        try {
            $musics = $this->musicRepository->findAll();
            $tags = $this->tagRepository->findAll();
            $playlist = $this->playlistRepository->find($id);
            $musicsPlaylist = $this->playlistRepository->findMusics($id);
            $user = $this->userRepository->find($playlist->userId());
            $tagsPlaylist = $this->playlistRepository->findTags($id);
            require_once __DIR__ . '/../Views/Playlist/show.php';
        } catch (PDOException $e) {
            $error = 'La playlist n\'a pas été trouvée';
            require_once __DIR__ . '/../Views/Components/alert-error.php';
            $this->index();
        }
    }

    public function update($id): void
    {
        try {
            $playlist = $this->playlistRepository->find($id);
            if (isset($_POST['musics'])) {
                foreach ($_POST['musics'] as $music) {
                    $this->playlistRepository->insertMusicPlaylist($music, $playlist->id());
                }
            }
            if (isset($_POST['tags'])) {
                $tags = array_unique($_POST["tags"]);
                foreach ($tags as $tag) {
                    $val = $this->playlistRepository->insertTagPlaylist($tag, $playlist->id());
                }
            }
            $success = "Playlist mise à jour avec succès";
            require_once __DIR__ . '/../Views/Components/alert-success.php';
            $this->show($id);
        } catch (PDOException  $e) {
            $error = 'La playlist n\'a pas été trouvée';
            require_once __DIR__ . '/../Views/Components/alert-error.php';
            $this->index();
        }
    }

    public function deleteMusic($id, $idMusic): void
    {
        try {
            $this->playlistRepository->removeMusic($idMusic, $id);
            $success = "Music suprimée";
            require_once __DIR__ . '/../Views/Components/alert-success.php';
            $this->show($id);
        } catch (PDOException $e) {
            $error = 'Une erreur est survenue';
            require_once __DIR__ . '/../Views/Components/alert-error.php';
            $this->index();
        }
    }

    public function deleteTag($id, $idTag): void
    {
        try {
            $this->playlistRepository->removeTag($idTag, $id);
            $success = "Tag suprimé";
            require_once __DIR__ . '/../Views/Components/alert-success.php';
            $this->show($id);
        } catch (PDOException $e) {
            $error = 'Une erreur est survenue';
            require_once __DIR__ . '/../Views/Components/alert-error.php';
            $this->index();
        }
    }
}
