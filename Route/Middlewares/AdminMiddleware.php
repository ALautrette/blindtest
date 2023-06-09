<?php

namespace Route\Middlewares;

class AdminMiddleware extends Middleware
{
    public function deniedView(): void
    {
        include 'App/Views/AccessDenied.php';
    }

    public function test(): bool
    {
        if (!isset($_SESSION['user'])) {
            return false;
        }
        return $_SESSION['user']->isAdmin();
    }
}
