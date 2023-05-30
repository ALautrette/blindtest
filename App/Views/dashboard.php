<?php
include 'App/Views/Layouts/BackOfficeMenu.php';
echo $_SESSION['user']->username() . ', you are logged in';
