<?php

namespace App\Models;

class Playlist
{
    public function __construct(
        private int $id,
        private string $name,
        private int $userId,
        private bool $isPublic,
    ) {}

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function isPublic(): bool
    {
        return $this->isPublic;
    }
}