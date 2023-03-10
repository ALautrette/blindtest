<?php

interface RepositoryInterface
{
    public function create($dataByColumns);

    public function find(int $id, ?array $columns);

    public function findAll(?array $columns);

    public function update(int $id, array $dataByColumns);

    public function delete(int $id);
}