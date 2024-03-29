<?php

namespace App\Models;

class Game
{
    public function __construct(
        private int $id,
        private string $date,
        private int $playlistId,
        private int $userId,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function date(): string
    {
        return $this->date;
    }

    public function playlistId(): int
    {
        return $this->playlistId;
    }

    public function userId(): int
    {
        return $this->userId;
    }
}
