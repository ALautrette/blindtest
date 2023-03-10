<?php

namespace App\Models;

class User
{
    public function __construct(
        private string $id,
        private string $username,
        private string $email,
        private string $password,
    ) {}

    public function id(): string
    {
        return $this->id;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function email(): string
    {
        return $this->email;
    }
}