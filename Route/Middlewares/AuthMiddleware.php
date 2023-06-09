<?php

namespace Route\Middlewares;

class AuthMiddleware extends Middleware
{
    public function test(): bool
    {
        return isset($_SESSION['user']);
    }

    public function deniedView(): void
    {
        header('Location: /');
    }
}
