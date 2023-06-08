<?php

namespace App\Models;

class Player
{
    public function __construct(
        private ?int $id,
        private string $username,
        private int $score
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function score(): string
    {
        return $this->score;
    }
}
