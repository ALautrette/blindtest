<?php

namespace App;

use PDO;
use PDOException;

class Connector
{
    private ?PDO $pdo;

    public function __construct()
    {
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'blindtest';

        try {
            $this->pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
        } catch (PDOException $exception) {
            exit('Failed to connect to database!');
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    protected function abstractFindAll(string $table, ?array $columns): array
    {
        if ($columns === null) {
            return $this->pdo->query("SELECT * FROM $table")->fetchAll();
        }

        $columns = implode(',', $columns);
        return $this->pdo->query("SELECT $columns FROM $table")->fetchAll();
    }

    protected function abstractFind(string $table, int $id, ?array $columns = null): array
    {
        if ($columns === null) {
            return $this->pdo->query("SELECT * FROM $table WHERE id = $id")->fetch();
        }

        $columns = implode(',', $columns);
        return $this->pdo->query("SELECT $columns FROM $table WHERE id = $id")->fetch();
    }

    protected function abstractUpdate(string $table, int $id, array $dataByColumns): array
    {
        $updateData = implode(',', array_map(fn($key, $value) => "$key = '$value'", array_keys($dataByColumns), $dataByColumns));
        $success = $this->pdo->query("UPDATE $table SET $updateData WHERE id = $id");
        if ($success) {
            return $this->abstractFind($table, $id);
        } else {
            throw new PDOException('Failed to update data');
        }
    }

    protected function abstractDelete(string $table, int $id): void
    {
        $this->pdo->query("DELETE FROM $table WHERE id = $id");
    }

    protected function abstractCreate(string $table, array $dataByColumns): array
    {
        $columns = implode(',', array_keys($dataByColumns));
        $values = implode(',', array_map(fn($value) => "'$value'", $dataByColumns));
        $success = $this->pdo->query("INSERT INTO $table ($columns) VALUES ($values)");
        if ($success) {
            return $this->abstractFind($table, $this->pdo->lastInsertId());
        } else {
            throw new PDOException('Failed to create data');
        }
    }
}
