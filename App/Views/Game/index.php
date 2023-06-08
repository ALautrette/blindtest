<?php


require_once 'App/Views/Layouts/BackOfficeMenu.php';
include 'App/Views/Layouts/head.php';
?>
    <section style="max-width: 1000px;margin:auto">

        <?= $_SESSION['user']->isAdmin() ? '<a href="/games/create" class="btn btn-primary my-3">Create a game</a>' : '' ?>
        <?php if (count($games) > 0) { ?>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Playlist</th>
                    <th scope="col">Host</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($games as $game) { ?>
                    <tr>
                        <th scope="row"><?= $game['id'] ?></th>
                        <td><?= $game['playlist_name'] ?></td>
                        <td><?= $game['host_username'] ?></td>
                        <td><?php $date = new DateTime($game['date']);
                            echo $date->format('d/m/Y \a\t H\:i') ?></td>
                        <td>
                            <a href="/play/<?= $game['id'] ?>/" class="btn btn-secondary"><i
                                        class="fa-solid fa-plus"></i></a>
                            <a href="/games/<?= $game['id'] ?>/update" class="btn btn-primary"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                            <a href="/games/<?= $game['id'] ?>/delete" class="btn btn-danger"><i
                                        class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        <?php } else { ?>
            <div>
                <p>You haven't hosted a game yet</p>
            </div>
        <?php } ?>
    </section>
<?php
include 'App/Views/Layouts/footer.php';
?>