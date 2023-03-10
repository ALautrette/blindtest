<?php

namespace App\Controllers;

use App\Connector;
use App\Repositories\UserRepository;

class TestController{
    public function show(){
        echo 'Mon controller';
        $userrepo = new UserRepository();
        $userrepo->create([
            'username' => 'erpo,g',
            'email' => 'email@gmail.com',
            'password' => 'ezokfnofnoni'
            ]);
        echo '<pre>';
        var_dump($userrepo->findAll());
        echo '</pre>';
    }
}