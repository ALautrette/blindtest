<?php

namespace App\Repositories;

use App\Models\User;
use App\Connector;

class UserRepository extends Connector implements RepositoryInterface
{
    private string $tableName = 'users';
    public function create($dataByColumns): User
    {
        $userData = $this->abstractCreate($this->tableName, $dataByColumns);
        return new User($userData['id'], $userData['username'], $userData['email'], $userData['password'], $userData['is_admin']);
    }

    public function find(int $id, ?array $columns = null): User
    {
        $userData = $this->abstractFind($this->tableName, $id, $columns);
        return new User($userData['id'], $userData['username'], $userData['email'], $userData['password'], $userData['is_admin']);
    }

    /**
     * @return User[]
     */
    public function findAll(?array $columns = null): array
    {
        $usersData = $this->abstractFindAll($this->tableName, $columns);
        $users = [];
        foreach ($usersData as $userData) {
            $users[] = new User($userData['id'], $userData['username'], $userData['email'], $userData['password'], $userData['is_admin']);
        }
        return $users;
    }

    public function update(int $id, array $dataByColumns): User
    {
        $userData = $this->abstractUpdate($this->tableName, $id, $dataByColumns);
        return new User($userData['id'], $userData['username'], $userData['email'], $userData['password'], $userData['is_admin']);
    }

    public function delete(int $id)
    {
        $this->abstractDelete($this->tableName, $id);
    }

    /**
     * @throws \Exception
     */
    public function findByEmail(string $email, ?array $columns = null): User
    {
        $userData = $this->abstractFindBy($this->tableName, 'email', $email, $columns);
        if ($userData === false) {
            throw new \Exception('Invalid email');
        }
        return new User($userData['id'], $userData['username'], $userData['email'], $userData['password']);
    }
}
