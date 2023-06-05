<?php

use App\Models\Music;

require_once 'App/Views/Layouts/BackOfficeMenu.php';
?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Titre</th>
        <th scope="col">Artiste</th>
        <th scope="col">Url</th>
        <th scope="col">Timecode</th>
        <th scope="col">Actions</th>

    </tr>
    </thead>
    <tbody>

    <?php /** @var Music[] $musics */
    foreach ($musics as $music) { ?>
        <tr>
            <th scope="row"><?= $music->id() ?></th>
            <td><?= $music->title() ?></td>
            <td><?= $music->artist() ?></td>
            <td><?= $music->url() ?></td>
            <td><?= $music->timecode() ?></td>
            <td>
                <a href="/musics/<?= $music->id() ?>/update" class="btn btn-primary">Modifier</a>
                <a href="/musics/<?= $music->id() ?>/delete" class="btn btn-danger">Supprimer</a>
            </td>
        </tr>
    <?php } ?>

    </tbody>
</table>