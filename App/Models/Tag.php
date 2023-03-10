<?php

namespace App\Models;

class Tag
{
    public function __construct(
        private int $id,
        private string $name,
    ) {}

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}