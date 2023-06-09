<?php

use Route\Middlewares\AdminMiddleware;
use Route\Middlewares\AuthMiddleware;
use Route\Middlewares\NotAuthMiddleware;
use Route\Router;

require_once './App/Models/User.php';
session_start();
require_once('Config/config.php');

spl_autoload_register(function ($class_name) {
    $class_name = str_replace("\\", "/", $class_name);
    require_once($class_name . '.php');
});

$router = new Router($_GET['url']);
$router->get('/', "Dashboard#index");
$router->get('/posts/:id', function ($id) {
    echo "Voila l'article $id";
});
$router->get('/test', "Test#show");
$router->get('/test/mail', "Test#sendMail");
$router->get('/test/user', "Test#testGetUser");
$router->get('/test/auth', 'Test#auth')->middleware(new AuthMiddleware());
$router->get('/test/admin', 'Test#auth')->middleware(new AdminMiddleware());
$router->get('/test/:id', "Test#acces");


$router->get('/users', "User#index")->middleware(new AdminMiddleware());
$router->get('/users/create', "User#createForm")->middleware(new AdminMiddleware());
$router->post('/users/create', "User#create")->middleware(new AdminMiddleware());
$router->get('/profile', "User#show")->middleware(new AuthMiddleware());
$router->get('/users/search', "User#showSearchForm")->middleware(new AuthMiddleware());
$router->post('/users/search', "User#showResults")->middleware(new AuthMiddleware());
$router->get('/users/:id/update', "User#updateForm")->middleware(new AdminMiddleware());
$router->post('/users/:id/update', "User#update")->middleware(new AdminMiddleware());
$router->get('/users/:id/delete', "User#delete")->middleware(new AdminMiddleware());
$router->get('/users/add/:userId', "User#addFriend")->middleware(new AuthMiddleware());



$router->get('/register', "Auth#create")->middleware(new NotAuthMiddleware());
$router->post('/register', "Auth#store")->middleware(new NotAuthMiddleware());

$router->get('/musics', "Music#index")->middleware(new AuthMiddleware());
$router->get('/musics/create', "Music#createForm")->middleware(new AuthMiddleware());
$router->post('/musics/create', "Music#create")->middleware(new AuthMiddleware());
$router->get('/musics/:id/update', "Music#updateForm")->middleware(new AuthMiddleware());
$router->post('/musics/:id/update', "Music#update")->middleware(new AuthMiddleware());
$router->get('/musics/:id/delete', "Music#delete")->middleware(new AdminMiddleware());

$router->get('/tags', "Tag#index")->middleware(new AuthMiddleware());
$router->get('/tags/create', "Tag#createForm")->middleware(new AuthMiddleware());
$router->post('/tags/create', "Tag#create")->middleware(new AuthMiddleware());
$router->get('/tags/:id/update', "Tag#updateForm")->middleware(new AuthMiddleware());
$router->post('/tags/:id/update', "Tag#update")->middleware(new AuthMiddleware());
$router->get('/tags/:id/delete', "Tag#delete")->middleware(new AuthMiddleware());

$router->get('/playlists', "Playlist#index")->middleware(new AuthMiddleware());
$router->get('/playlists/create', "Playlist#createForm")->middleware(new AuthMiddleware());
$router->post('/playlists/create', "Playlist#create")->middleware(new AuthMiddleware());
$router->get('/playlists/delete/:id', "Playlist#delete")->middleware(new AuthMiddleware());
$router->get('/playlists/:id', "Playlist#show")->middleware(new AuthMiddleware());
;
$router->post('/playlists/:id/update', "Playlist#update")->middleware(new AuthMiddleware());
;
$router->get('/playlists/:id/music/delete/:idMusic', "Playlist#deleteMusic")->middleware(new AuthMiddleware());
;
$router->get('/playlists/:id/tag/delete/:idTag', "Playlist#deleteTag")->middleware(new AuthMiddleware());
;


$router->get('/games', "Game#index")->middleware(new AuthMiddleware());
$router->get('/games/create', "Game#createForm")->middleware(new AdminMiddleware());
$router->post('/games/create', "Game#create")->middleware(new AuthMiddleware());
$router->get('/games/:id/update', "Game#updateForm")->middleware(new AuthMiddleware());
$router->post('/games/:id/update', "Game#update")->middleware(new AuthMiddleware());
$router->get('/games/:id/delete', "Game#delete")->middleware(new AuthMiddleware());

$router->get('/login', "Auth#loginPage")->middleware(new NotAuthMiddleware());
$router->post('/login', "Auth#login")->middleware(new NotAuthMiddleware());

$router->get('/logout', "Auth#logout")->middleware(new AuthMiddleware());

$router->get("/reset", "Auth#resetPage")->middleware(new NotAuthMiddleware()); //Voir perms Gab
$router->post("/reset", "Auth#reset")->middleware(new NotAuthMiddleware()); //Voir perms Gab

$router->get("/newpassword", "Auth#newPwdPage")->middleware(new NotAuthMiddleware());
$router->post("/newpassword", "Auth#newPwd")->middleware(new NotAuthMiddleware());

$router->get('/dashboard', "Dashboard#index");

$router->get('/play', "Play#index")->middleware(new AuthMiddleware());
$router->get('/play/:id', "Play#show")->middleware(new AuthMiddleware());

$router->post('api/play/nextMusic', "Play#getNextMusic");
$router->post('api/play/create', "Game#newUserGame");
$router->post('api/play/checkUser', "User#findByUsername");


$router->run();
