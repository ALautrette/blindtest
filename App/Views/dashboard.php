<?php
include 'App/Views/Layouts/head.php';
include 'App/Views/Layouts/BackOfficeMenu.php';

echo $_SESSION['user']->username() . ', you are logged in';

include 'App/Views/Layouts/footer.php';
