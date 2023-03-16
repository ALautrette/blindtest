<?php

namespace Route\Middlewares;

abstract class Middleware
{
    abstract public function test(): bool;

    abstract public function deniedView(): void;
}