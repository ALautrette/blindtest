<?php

use Route\Middlewares\AuthMiddleware;
use Route\Router;

require_once('Config/config.php');
require_once './App/Views/Layouts/head.php';

spl_autoload_register(function ($class_name) {
    $class_name = str_replace("\\", "/", $class_name);
    require_once($class_name . '.php');
});

$router = new Router($_GET['url']);
$router->get('/', function () {
    echo "Bienvenue sur ma homepage !";
});
$router->get('/posts/:id', function ($id) {
    echo "Voila l'article $id";
});
$router->get('/test', "Test#show");
$router->get('/test/auth', 'Test#auth')->middleware(new AuthMiddleware());
$router->get('/test/:id', "Test#acces");


$router->get('/users', "User#index");
$router->get('/users/create', "User#createForm");
$router->post('/users/create', "User#create");
$router->get('/register', "Auth#create");
$router->post('/register', "Auth#store");

$router->get('/login', "Auth#loginPage");
$router->post('/login', "Auth#login");

$router->run();
