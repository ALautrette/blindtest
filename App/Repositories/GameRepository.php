<?php

namespace App\Repositories;

use App\Models\Game;
use App\Connector;

class GameRepository extends Connector implements RepositoryInterface
{
    private string $tableName = 'games';
    public function create($dataByColumns): Game
    {
        $gameData = $this->abstractCreate($this->tableName, $dataByColumns);
        return new Game($gameData['id'], $gameData['date'], $gameData['playlist_id'], $gameData['user_id']);
    }

    public function find(int $id, ?array $columns = null): Game
    {
        $gameData = $this->abstractFind($this->tableName, $id, $columns);
        return new Game($gameData['id'], $gameData['date'], $gameData['playlist_id'], $gameData['user_id']);
    }

    /**
     * @return Game[]
     */
    public function findAll(?array $columns = null): array
    {
        $gamesData = $this->abstractFindAll($this->tableName, $columns);

        $games = [];
        foreach ($gamesData as $gameData) {
            $games[] = new Game($gameData['id'], $gameData['date'], $gameData['playlist_id'], $gameData['user_id']);
        }

        return $games;
    }

    /**
     * @return Game[]
     */

    public function update(int $id, array $dataByColumns): Game
    {
        $gameData = $this->abstractUpdate($this->tableName, $id, $dataByColumns);
        return new Game($gameData['id'], $gameData['date'], $gameData['playlist_id'], $gameData['user_id']);
    }

    public function delete(int $id)
    {
        $this->abstractDelete($this->tableName, $id);
    }

    public function findAllWithRelations(): false|array
    {
        return $this->pdo->query("SELECT games.id, games.date, playlists.name AS playlist_name, users.username AS host_username
            FROM games, playlists, users
            WHERE games.playlist_id = playlists.id 
            AND games.user_id = users.id")
            ->fetchAll();
    }
}
