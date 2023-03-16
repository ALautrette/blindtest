<?php

namespace App\Repositories;

use App\Connector;
use App\Models\Music;

class MusicRepository extends Connector implements RepositoryInterface
{
    private string $tableName = 'musics';
    public function create($dataByColumns): Music
    {
        $musicData = $this->abstractCreate($this->tableName, $dataByColumns);
        return new Music($musicData['id'], $musicData['url'], $musicData['title'], $musicData['artist'], $musicData['timecode']);
    }

    public function find(int $id, ?array $columns = null): Music
    {
        $musicData = $this->abstractFind($this->tableName, $id, $columns);
        return new Music($musicData['id'], $musicData['url'], $musicData['title'], $musicData['artist'], $musicData['timecode']);
    }

    /**
     * @return Music[]
     */
    public function findAll(?array $columns = null): array
    {
        $musicsData = $this->abstractFindAll($this->tableName, $columns);

        $musics = [];
        foreach ($musicsData as $musicData) {
            $musics[] = new Music($musicData['id'], $musicData['url'], $musicData['title'], $musicData['artist'], $musicData['timecode']);
        }

        return $musics;
    }

    public function update(int $id, array $dataByColumns): Music
    {
        $musicData = $this->abstractUpdate($this->tableName, $id, $dataByColumns);
        return new Music($musicData['id'], $musicData['url'], $musicData['title'], $musicData['artist'], $musicData['timecode']);
    }

    public function delete(int $id)
    {
        $this->abstractDelete($this->tableName, $id);
    }
}
