<?php

namespace App\Repositories;

use App\Connector;
use App\Models\Music;
use App\Models\Playlist;
use App\Models\Tag;
use PDO;
use PDOException;

class PlaylistRepository extends Connector implements RepositoryInterface
{
    private string $tableName = 'playlists';

    public function create($dataByColumns): Playlist
    {
        $musicData = $this->abstractCreate($this->tableName, $dataByColumns);
        return new Playlist($musicData['id'], $musicData['name'], $musicData['user_id'], $musicData['is_public']);
    }

    public function find(int $id, ?array $columns = null): Playlist
    {
        $musicData = $this->abstractFind($this->tableName, $id, $columns);
        return new Playlist($musicData['id'], $musicData['name'], $musicData['user_id'], $musicData['is_public']);
    }

    /**
     * @return Playlist[]
     */
    public function findAll(?array $columns = null): array
    {
        $musicsData = $this->abstractFindAll($this->tableName, $columns);

        $musics = [];
        foreach ($musicsData as $musicData) {
            $musics[] = new Playlist($musicData['id'], $musicData['name'], $musicData['user_id'], $musicData['is_public']);
        }

        return $musics;
    }

    public function update(int $id, array $dataByColumns): Playlist
    {
        $musicData = $this->abstractUpdate($this->tableName, $id, $dataByColumns);
        return new Playlist($musicData['id'], $musicData['name'], $musicData['user_id'], $musicData['is_public']);
    }

    public function delete(int $id): void
    {
        $this->abstractDelete($this->tableName, $id);
    }

    public function insertMusicPlaylist(int $musicId, int $playlistId): int
    {
        $success = $this->pdo->prepare(
            "insert into music_playlist (music_id, playlist_id) values (?, ?)"
        )->execute([$musicId, $playlistId]);

        if (!$success) {
            throw new PDOException('Failed to create data');
        }
        return $this->pdo->lastInsertId();
    }

    /**
     * @param int $playlistId
     * @return Music[]
     */
    public function findMusics(int $playlistId): array
    {
        $query = $this->pdo->prepare(
            "select musics.id, musics.url, musics.title, musics.artist, musics.timecode
            from musics inner join music_playlist on musics.id = music_playlist.music_id 
            where playlist_id = ?"
        );
        $query->execute([$playlistId]);
        $musicData = $query->fetchAll(PDO::FETCH_ASSOC);
        $musics = [];
        foreach ($musicData as $music) {
            $musics[] = new Music($music["id"], $music["url"], $music["title"], $music["artist"], $music["timecode"]);
        }
        return $musics;
    }

    public function insertTagPlaylist(int $tagId, int $playlistId): int
    {
        $success = $this->pdo->prepare(
            "insert into playlist_tag (tag_id, playlist_id) values (?, ?)"
        )->execute([$tagId, $playlistId]);

        if (!$success) {
            throw new PDOException('Failed to create data');
        }
        return $this->pdo->lastInsertId();
    }

    /**
     * @param int $playlistId
     * @return Tag[]
     */
    public function findTags(int $playlistId): array
    {
        $query = $this->pdo->prepare(
            "select tags.id, tags.name
            from tags inner join playlist_tag on tags.id = playlist_tag.tag_id 
            where playlist_id = ?"
        );
        $query->execute([$playlistId]);
        $tagData = $query->fetchAll(PDO::FETCH_ASSOC);
        $tags = [];
        foreach ($tagData as $tag) {
            $tags[] = new Tag($tag["id"], $tag["name"]);
        }
        return $tags;
    }
}
