<?php

namespace App\Repositories;

use App\Models\User;
use App\Connector;
use PDO;

class UserRepository extends Connector implements RepositoryInterface
{
    private string $tableName = 'users';

    public function create($dataByColumns): User
    {
        $userData = $this->abstractCreate($this->tableName, $dataByColumns);
        return new User($userData['id'], $userData['username'], $userData['email'], $userData['password'], $userData['reset_token'], $userData['token_expiry'], $userData['is_admin']);
    }

    public function find(int $id, ?array $columns = null): User
    {
        $userData = $this->abstractFind($this->tableName, $id, $columns);
        return new User($userData['id'], $userData['username'], $userData['email'], $userData['password'], $userData['reset_token'], $userData['token_expiry'], $userData['is_admin']);
    }

    /**
     * @return User[]
     */
    public function findAll(?array $columns = null): array
    {
        $usersData = $this->abstractFindAll($this->tableName, $columns);
        $users = [];
        foreach ($usersData as $userData) {
            $users[] = new User($userData['id'], $userData['username'], $userData['email'], $userData['password'], $userData['reset_token'], $userData['token_expiry'], $userData['is_admin']);
        }
        return $users;
    }

    public function update(int $id, array $dataByColumns): User
    {
        $userData = $this->abstractUpdate($this->tableName, $id, $dataByColumns);
        return new User($userData['id'], $userData['username'], $userData['email'], $userData['password'], $userData['reset_token'], $userData['token_expiry'], $userData['is_admin']);
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
        return new User($userData['id'], $userData['username'], $userData['email'], $userData['password'], $userData['reset_token'], $userData['token_expiry'], $userData['is_admin']);
    }

    /**
     * @throws \Exception
     */
    public function findByResetToken(string $token, ?array $columns = null): User
    {
        $userData = $this->abstractFindBy($this->tableName, 'reset_token', $token, $columns);
        if ($userData === false) {
            throw new \Exception("The token doesn't lead to any user");
        }
        return new User($userData['id'], $userData['username'], $userData['email'], $userData['password'], $userData['reset_token'], $userData['token_expiry'], $userData['is_admin']);
    }

    public function findByUsername(string $username, ?array $columns = null): User
    {
        $userData = $this->abstractFindBy($this->tableName, 'username', $username, $columns);
        if ($userData === false) {
            throw new \Exception('Invalid username');
        }
        return new User($userData['id'], $userData['username'], $userData['email'], $userData['password'], $userData['reset_token'], $userData['token_expiry'], $userData['is_admin']);
    }

    public function addFriend($user1Id, $user2Id): int
    {
        $query = $this->pdo->prepare(
            "insert into user_user (first_user_id, second_user_id) values (?, ?)"
        );
        $success = $query->execute([$user1Id, $user2Id]);
        if (!$success) {
            throw new PDOException('Failed to create data');
        }
        return $this->pdo->lastInsertId();
    }

    /**
     * @return string[]
     */
    public function getUsersUsername($username): array
    {
        $query = $this->pdo->prepare(
            "select id, username from users where username like CONCAT('%', ?, '%')"
        );
        $query->execute([$username]);
        return $query->fetchAll();
    }

    /**
     * @param $id
     * @return User[]
     */
    public function getFriends($id): array
    {
        $query = $this->pdo->prepare("select first_user_id, second_user_id from user_user where first_user_id = ? or second_user_id = ?");
        $query->execute([$id, $id]);
        $usersData = $query->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($usersData as $userData) {
            if ($userData["first_user_id"] == $id) {
                $users[] = $this->find($userData["second_user_id"]);
            } else {
                $users[] = $this->find($userData["first_user_id"]);
            }
        }
        return $users;
    }
}
