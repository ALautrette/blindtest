<?php

use Route\Middlewares\AdminMiddleware;
use Route\Middlewares\AuthMiddleware;
use Route\Router;

require_once './App/Models/User.php';
session_start();
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
$router->get('/test/admin', 'Test#auth')->middleware(new AdminMiddleware());
$router->get('/test/:id', "Test#acces");


$router->get('/users', "User#index");
$router->get('/users/create', "User#createForm");
$router->post('/users/create', "User#create");
$router->get('/register', "Auth#create");
$router->post('/register', "Auth#store");

$router->get('/musics', "Music#index");
$router->get('/musics/create', "Music#createForm");

$router->get('/tags', "Tag#index");
$router->get('/tags/create', "Tag#createForm");

$router->get('/playlists', "Playlist#index");
$router->get('/playlists/create', "Playlist#createForm");

$router->get('/games', "Game#index");
$router->get('/games/create', "Game#createForm");

$router->get('/login', "Auth#loginPage");
$router->post('/login', "Auth#login");

$router->get("/reset", "Auth#resetPage");
$router->post("/reset", "Auth#reset");

$router->get("/newpassword", "Auth#newPwdPage");
$router->post("/newpassword", "Auth#newPwd");

$router->get('/dashboard', "Dashboard#index");

$router->run();
