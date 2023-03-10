<?php

use App\Models\User;

class UserRepository extends Connector implements RepositoryInterface
{
    private string $tableName = 'users';
    public function create($dataByColumns): User
    {
        $userData = $this->abstractCreate($this->tableName, $dataByColumns);
        return new User($userData['id'], $userData['username'], $userData['email'], $userData['password']);
    }

    public function find(int $id, ?array $columns): User
    {
        $userData = $this->abstractFind($this->tableName, $id, $columns);
        return new User($userData['id'], $userData['username'], $userData['email'], $userData['password']);
    }

    /**
     * @return User[]
     */
    public function findAll(?array $columns): array
    {
        $usersData = $this->abstractFindAll($this->tableName, $columns);
        $users = [];
        foreach ($usersData as $userData) {
            $users[] = new User($userData['id'], $userData['username'], $userData['email'], $userData['password']);
        }
        return $users;
    }

    public function update(int $id, array $dataByColumns): User
    {
        $userData = $this->abstractUpdate($this->tableName, $id, $dataByColumns);
        return new User($userData['id'], $userData['username'], $userData['email'], $userData['password']);
    }

    public function delete(int $id)
    {
        $this->abstractDelete($this->tableName, $id);
    }
}
