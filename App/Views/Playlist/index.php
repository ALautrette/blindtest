<?php

use App\Models\Playlist;
use App\Models\User;

require_once 'App/Views/Layouts/BackOfficeMenu.php';
?>
<a href="/playlists/create" class="btn btn-primary">Créer une playlist</a>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nom</th>
        <th scope="col">Créateur</th>
        <th scope="col">Publique</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    <?php /** @var Playlist[] $playlists */
    foreach ($playlists as $playlist) { ?>
        <tr>
            <th scope="row"><?= $playlist->id() ?></th>
            <td><?= $playlist->name() ?></td>
            <td><?= $playlist->userId() ?></td>
            <td><?= $playlist->isPublic() ? "oui" : "non" ?></td>
            <td>
                <a class="btn btn-outline-primary" href="/playlists/<?= $playlist->id() ?>"><i class="fa-solid fa-eye"></i></a>
                <a class="btn btn-outline-danger" href="/playlists/delete/<?= $playlist->id() ?>"><i class="fa-solid fa-trash"></i>
                </a>

            </td>
        </tr>
    <?php } ?>

    </tbody>
</table>