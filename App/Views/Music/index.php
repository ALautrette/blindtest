<?php

use App\Models\Music;

include 'App/Views/Layouts/BackOfficeMenu.php';
include 'App/Views/Layouts/head.php';
?>
    <section style="max-width: 1000px;margin:auto">
        <a href="/musics/create" class="btn btn-primary my-3">Add a music</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Artist</th>
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
                        <a href="/musics/<?= $music->id() ?>/update" class="btn btn-primary"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        <a href="/musics/<?= $music->id() ?>/delete" class="btn btn-danger"><i
                                    class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>

            </tbody>
        </table>
    </section>
<?php
include 'App/Views/Layouts/footer.php';
?>