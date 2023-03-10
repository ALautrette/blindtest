<?php

namespace App;

use PDO;
use PDOException;

class Connector
{
    private ?PDO $pdo;

    public function __construct()
    {
        $DATABASE_HOST = $GLOBALS['DATABASE_HOST'];
        $DATABASE_USER = $GLOBALS['DATABASE_USER'];
        $DATABASE_PASS = $GLOBALS['DATABASE_PASS'];
        $DATABASE_NAME = $GLOBALS['DATABASE_NAME'];

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

    protected function abstractFindBy(string $table, string $column, mixed $value, ?array $columns = null): array
    {
        if ($columns === null) {
            return $this->pdo->query("SELECT * FROM $table WHERE $column = $value")->fetch();
        }

        $columns = implode(',', $columns);
        return $this->pdo->query("SELECT $columns FROM $table WHERE $column = $value")->fetch();
    }

    protected function abstractUpdate(string $table, int $id, array $dataByColumns): array
    {
        $columnsToUpdate = implode(',', array_map(fn($columnName) => "$columnName = :$columnName", array_keys($dataByColumns)));
        $sql = "UPDATE $table SET $columnsToUpdate WHERE id = :id";
        $success = $this->pdo
            ->prepare($sql)
            ->execute([...$dataByColumns, ...['id' => $id]]);

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
        $preparedValues = implode(',', array_fill(0, count($dataByColumns), '?'));
        $success = $this->pdo
            ->prepare("INSERT INTO $table ($columns) VALUES ($preparedValues)")
            ->execute(array_values($dataByColumns));

        if ($success) {
            return $this->abstractFind($table, $this->pdo->lastInsertId());
        } else {
            throw new PDOException('Failed to create data');
        }
    }
}
