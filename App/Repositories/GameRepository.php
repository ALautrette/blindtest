<?php

namespace App\Repositories;

use App\Models\Game;
use App\Connector;
use App\Models\Player;
use App\Models\User;

class GameRepository extends Connector implements RepositoryInterface
{
    private string $tableName = 'games';

    public function create($dataByColumns): Game
    {
        $gameData = $this->abstractCreate($this->tableName, $dataByColumns);
        return new Game($gameData['id'], $gameData['date'], $gameData['playlist_id'], $gameData['user_id'], $gameData['step']);
    }

    public function find(int $id, ?array $columns = null): Game
    {
        $gameData = $this->abstractFind($this->tableName, $id, $columns);
        return new Game($gameData['id'], $gameData['date'], $gameData['playlist_id'], $gameData['user_id'], $gameData['step']);
    }

    /**
     * @return Game[]
     */
    public function findAll(?array $columns = null): array
    {
        $gamesData = $this->abstractFindAll($this->tableName, $columns);

        $games = [];
        foreach ($gamesData as $gameData) {
            $games[] = new Game($gameData['id'], $gameData['date'], $gameData['playlist_id'], $gameData['user_id'], $gameData['step']);
        }

        return $games;
    }

    /**
     * @return Game[]
     */

    public function update(int $id, array $dataByColumns): Game
    {
        $gameData = $this->abstractUpdate($this->tableName, $id, $dataByColumns);
        return new Game($gameData['id'], $gameData['date'], $gameData['playlist_id'], $gameData['user_id'], $gameData['step']);
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
            AND games.user_id = users.id order by games.id DESC")
            ->fetchAll();
    }

    public function addUsers(int $id, array $userIds): void
    {
        foreach ($userIds as $userId) {
            $this->pdo->query("INSERT INTO game_user (game_id, user_id) VALUES ($id, $userId)");
        }
    }

    public function updateUserScore($gameId, $userId): void
    {
        $this->pdo->query("UPDATE game_user SET score = score + 1 WHERE game_id = $gameId AND user_id = $userId");
    }

    public function findAllUserGameWithRelations($userId)
    {
        return $this->pdo->query("SELECT games.id, games.date, playlists.name AS playlist_name, users.username AS host_username
            FROM games, playlists, users
            WHERE (games.playlist_id = playlists.id AND games.user_id = users.id)
            AND games.user_id = $userId order by games.id DESC ")
            ->fetchAll();
    }

    public function getGameUsers($gameId)
    {
        $playersData = $this->pdo->query("SELECT users.id, users.username, game_user.score FROM game_user, users WHERE game_user.game_id = $gameId AND game_user.user_id = users.id ORDER BY game_user.score DESC")->fetchAll();
        $players = [];
        foreach ($playersData as $playerData) {
            $players[] = new Player($playerData['id'], $playerData['username'], $playerData['score']);
        }
        return $players;
    }
}
