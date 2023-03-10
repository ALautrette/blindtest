<?php

namespace App\Models;

class Music
{
    public function __construct(
        private int $id,
        private string $url,
        private string $title,
        private string $artist,
        private int $timecode,
    ) {}

    public function id(): string
    {
        return $this->id;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function title(): string
    {
        return $this->title;
    }
    public function artist(): string
    {
        return $this->artist;
    }

    public function timecode(): int
    {
        return $this->timecode;
    }
}