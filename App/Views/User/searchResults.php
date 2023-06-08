<?php
include 'App/Views/Layouts/head.php';
include 'App/Views/Layouts/BackOfficeMenu.php';
?>

    <div>

        <?php
        /** @var array $users */
        if ($users) {
            ?>
            <ul class="list-group">
                <?php
                foreach ($users as $username) {
                    /** @var \App\Models\User $user */
                    if ($user->username() != $username["username"]) { ?>
                        <li class="list-group-item"><?= $username["username"] ?> <a
                                    href="/users/add/<?= $username["id"] ?>" class="btn btn-info">Add</a></li>
                    <?php }
                    } ?>
            </ul> <?php } else {
                ?>
            <p>Aucun résultat</p>
            <?php
            } ?>
    </div>

<?php
include 'App/Views/Layouts/footer.php';
?>