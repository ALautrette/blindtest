<?php
include 'App/Views/Layouts/head.php';
include 'App/Views/Layouts/BackOfficeMenu.php';
?>
    <section class="container my-5 bg-dark" style="max-width: 1000px;margin:auto;border-radius: 1rem;">
        <div class="text-white p-3">
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
                    <p>No results</p>
                    <?php
                } ?>
            </div>
        </div>
    </section>
<?php
include 'App/Views/Layouts/footer.php';
?>