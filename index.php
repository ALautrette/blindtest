<?php

use Route\Router;

spl_autoload_register(function ($class_name) {
    require($class_name . '.php');
});

$router = new Router($_GET['url']);
$router->get('/', function () {
    echo "Bienvenue sur ma homepage !";
});
$router->get('/posts/:id', function ($id) {
    echo "Voila l'article $id";
});
$router->get('/test', "Test#show");
$router->get('/test/:id', "Test#acces");

$router->get('/users', "User#index");

$router->run();
