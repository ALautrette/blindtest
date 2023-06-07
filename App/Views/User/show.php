<?php
include 'App/Views/Layouts/head.php';
include 'App/Views/Layouts/BackOfficeMenu.php';
?>

    <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <p type="text" class="form-control"><?= /** @var \App\Models\User $user */
            $user->username() ?></p>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <p type="email" class="form-control"><?= $user->email() ?>
    </div>
    <div>
        <label for="">Amis</label>
        <ul class="list-group">
            <?php /** @var \App\Models\User[] $friends */
            if (!$friends) {
                ?>
                <li class="list-group-item">Liste vide</li>
            <?php } else {
                foreach ($friends as $friend) {
                    ?>
                    <li class="list-group-item"><?= $friend->username() ?></li>
                <?php }
                } ?>

        </ul>
    </div>
    <a href="/users/search" class="btn btn-info">Ajouter un ami</a>

<?php
include 'App/Views/Layouts/footer.php';
?>