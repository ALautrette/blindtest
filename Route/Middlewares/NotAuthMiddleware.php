<?php

namespace Route\Middlewares;

class NotAuthMiddleware extends Middleware
{

    public function test(): bool
    {
        return !isset($_SESSION['user']);
    }

    public function deniedView(): void
    {
        echo 'Access Denied';
    }
}