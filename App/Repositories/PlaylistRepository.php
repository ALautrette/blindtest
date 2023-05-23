<?php

namespace App\Repositories;

use App\Connector;
use App\Models\Music;
use App\Models\Playlist;

class PlaylistRepository extends Connector implements RepositoryInterface
{
    private string $tableName = 'playlists';
    public function create($dataByColumns): Playlist
    {
        $playlistData = $this->abstractCreate($this->tableName, $dataByColumns);
        return new Playlist($playlistData['id'], $playlistData['name'], $playlistData['user_id'], $playlistData['is_public']);
    }

    public function find(int $id, ?array $columns = null): Playlist
    {
        $playlistData = $this->abstractFind($this->tableName, $id, $columns);
        return new Playlist($playlistData['id'], $playlistData['name'], $playlistData['user_id'], $playlistData['is_public']);
    }

    /**
     * @return Playlist[]
     */
    public function findAll(?array $columns = null): array
    {
        $playlistsData = $this->abstractFindAll($this->tableName, $columns);

        $playlists = [];
        foreach ($playlistsData as $playlistData) {
            $playlists[] = new Playlist($playlistData['id'], $playlistData['name'], $playlistData['user_id'], $playlistData['is_public']);
        }

        return $playlists;
    }

    public function update(int $id, array $dataByColumns): Playlist
    {
        $playlistData = $this->abstractUpdate($this->tableName, $id, $dataByColumns);
        return new Playlist($playlistData['id'], $playlistData['name'], $playlistData['user_id'], $playlistData['is_public']);
    }

    public function delete(int $id)
    {
        $this->abstractDelete($this->tableName, $id);
    }
}
