<?php
include 'App/Views/Layouts/head.php';
include 'App/Views/Layouts/BackOfficeMenu.php';
?>

    <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <p type="text" class="form-control" name="username"><?= /** @var \App\Models\User $user */
            $user->username() ?></p>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <p type="email" class="form-control"><?= $user->email() ?>
    </div>


<?php
include 'App/Views/Layouts/footer.php';
?>