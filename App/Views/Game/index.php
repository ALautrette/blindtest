<?php


require_once 'App/Views/Layouts/BackOfficeMenu.php';
?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Playlist</th>
        <th scope="col">Hôte</th>
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
            <td><?= $game['date'] ?></td>
            <td>
                <a href="/games/<?= $game['id'] ?>/update" class="btn btn-primary">Modifier</a>
                <a href="/games/<?= $game['id'] ?>/delete" class="btn btn-danger">Supprimer</a>
            </td>
        </tr>
    <?php } ?>

    </tbody>
</table>