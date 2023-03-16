<?php

namespace Route\Middlewares;

class AdminMiddleware extends Middleware
{
    public function deniedView(): void
    {

        echo 'Access Denied';
    }

    public function test(): bool
    {
        if(isset($_SESSION['user'])){
            return false;
        }
        return $_SESSION['user']->isAdmin();
    }
}