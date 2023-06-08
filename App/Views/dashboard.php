<?php
include 'App/Views/Layouts/head.php';
include 'App/Views/Layouts/BackOfficeMenu.php';

if (\App\Models\User::isLoggedIn()) {
    //echo \App\Models\User::getCurrentUser()->username() . ', you are logged in';
    ?>
    <section style="max-width: 1000px;margin:auto">
        <h1 class="display-4">Welcome to BlindTest</h1>
        <p class="lead">Test your music knowledge with quizzes made by the community!</p>
        <a class="btn btn-primary btn-lg" href="/play" role="button">Start a game</a>
    </section>
    <?php
} else {
    echo "Bienvenue sur notre super Blindtest :)";
}


include 'App/Views/Layouts/footer.php';
