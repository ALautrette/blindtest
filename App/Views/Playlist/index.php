<?php

use App\Models\Playlist;

include 'App/Views/Layouts/BackOfficeMenu.php';
include 'App/Views/Layouts/head.php';
?>
    <section style="max-width: 1000px;margin:auto">
        <a href="/playlists/create" class="btn btn-primary my-3">Create a playlist</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Author</th>
                <th scope="col">Public</th>
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
                    <td><?= $playlist->isPublic() ? "yes" : "no" ?></td>
                    <td>
                        <a class="btn btn-primary" href="/playlists/<?= $playlist->id() ?>"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        <a class="btn btn-danger" href="/playlists/delete/<?= $playlist->id() ?>"><i
                                    class="fa-solid fa-trash"></i>
                        </a>

                    </td>
                </tr>
            <?php } ?>

            </tbody>
        </table>
    </section>
<?php
include 'App/Views/Layouts/footer.php';
?>