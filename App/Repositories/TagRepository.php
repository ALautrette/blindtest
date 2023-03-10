<?php

namespace App\Repositories;

use App\Connector;
use App\Models\Tag;

class TagRepository extends Connector implements RepositoryInterface
{
    private string $tableName = 'tags';
    public function create($dataByColumns): Tag
    {
        $tagData = $this->abstractCreate($this->tableName, $dataByColumns);
        return new Tag($tagData['id'], $tagData['name']);
    }

    public function find(int $id, ?array $columns = null): Tag
    {
        $tagData = $this->abstractFind($this->tableName, $id, $columns);
        return new Tag($tagData['id'], $tagData['name']);    }

    /**
     * @return Tag[]
     */
    public function findAll(?array $columns = null): array
    {
        $tagsData = $this->abstractFindAll($this->tableName, $columns);
        
        $tags = [];
        foreach ($tagsData as $tagData) {
            $tags[] = new Tag($tagData['id'], $tagData['name']);
        }
        
        return $tags;
    }

    public function update(int $id, array $dataByColumns): Tag
    {
        $tagData = $this->abstractUpdate($this->tableName, $id, $dataByColumns);
        return new Tag($tagData['id'], $tagData['url'], $tagData['title'], $tagData['artist'], $tagData['timecode']);
    }

    public function delete(int $id)
    {
        $this->abstractDelete($this->tableName, $id);
    }
}
