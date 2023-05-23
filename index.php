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

$router->get('/musics', "Music#index")->middleware(new AuthMiddleware());
$router->get('/musics/create', "Music#createForm")->middleware(new AuthMiddleware());
$router->post('/musics/create', "Music#create")->middleware(new AuthMiddleware());
$router->get('/musics/:id/update', "Music#updateForm")->middleware(new AuthMiddleware());
$router->post('/musics/:id/update', "Music#update")->middleware(new AuthMiddleware());
$router->get('/musics/:id/delete', "Music#delete")->middleware(new AuthMiddleware());

$router->get('/tags', "Tag#index");
$router->get('/tags/create', "Tag#createForm");
$router->post('/tags/create', "Tag#create");
$router->get('/tags/:id/update', "Tag#updateForm");
$router->post('/tags/:id/update', "Tag#update");
$router->get('/tags/:id/delete', "Tag#delete");

$router->get('/playlists', "Playlist#index")->middleware(new AdminMiddleware());
$router->get('/playlists/create', "Playlist#createForm")->middleware(new AdminMiddleware());
$router->post('/playlists/create', "Playlist#create")->middleware(new AdminMiddleware());
$router->get('/playlists/delete/:id', "Playlist#delete")->middleware(new AdminMiddleware());
$router->get('/playlists/:id', "Playlist#show");

$router->get('/games', "Game#index")->middleware(new AuthMiddleware());
$router->get('/games/create', "Game#createForm")->middleware(new AuthMiddleware());
$router->post('/games/create', "Game#create")->middleware(new AuthMiddleware());
$router->get('/games/:id/update', "Game#updateForm")->middleware(new AuthMiddleware());
$router->post('/games/:id/update', "Game#update")->middleware(new AuthMiddleware());
$router->get('/games/:id/delete', "Game#delete")->middleware(new AuthMiddleware());

$router->get('/login', "Auth#loginPage");
$router->post('/login', "Auth#login");

$router->get("/reset", "Auth#resetPage");
$router->post("/reset", "Auth#reset");

$router->get("/newpassword", "Auth#newPwdPage");
$router->post("/newpassword", "Auth#newPwd");

$router->get('/dashboard', "Dashboard#index");

$router->run();

require_once './App/Views/Layouts/footer.php';