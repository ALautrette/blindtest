<?php
include 'App/Views/Layouts/head.php';
include 'App/Views/Layouts/BackOfficeMenu.php';

if(\App\Models\User::isLoggedIn()){
    echo \App\Models\User::getCurrentUser()->username() . ', you are logged in';
} else {
    echo "Bienvenue sur notre super Blindtest :)";
}


include 'App/Views/Layouts/footer.php';
