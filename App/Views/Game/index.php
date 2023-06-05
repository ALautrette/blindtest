<?php

use App\Models\Game;
use App\Models\User;

require_once 'App/Views/Layouts/BackOfficeMenu.php';
include 'App/Views/Layouts/head.php';
?>
<a href="/games/create" class="btn btn-primary">Créer une partie</a>
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
            <td><?php $date = new DateTime($game['date']);
            echo $date->format('d/m/Y \à H\hi') ?></td>
            <td>
                <a href="/games/<?= $game['id'] ?>/update" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="/games/<?= $game['id'] ?>/delete" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
    <?php } ?>

    </tbody>
</table>
<?php
include 'App/Views/Layouts/footer.php';
?>