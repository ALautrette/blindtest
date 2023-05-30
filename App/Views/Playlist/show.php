<?php

use App\Models\Playlist;
use App\Models\Music;

include 'App/Views/Layouts/BackOfficeMenu.php';

include 'App/Views/Layouts/head.php';

?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nom</th>
        <th scope="col">Créateur</th>
        <th scope="col">Publique</th>
    </tr>
    </thead>

    <tr>
        <th scope="row"><?= /** @var Playlist $playlist */
            $playlist->id() ?></th>
        <td><?= $playlist->name() ?></td>
        <td><?= $playlist->userId() ?></td>
        <td><?= $playlist->isPublic() ? "oui" : "non" ?></td>
    </tr>
    </tbody>
</table>


<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Titre</th>
        <th scope="col">Artiste</th>
        <th scope="col">Url</th>
        <th scope="col">Timecode</th>
    </tr>
    </thead>
    <tbody>

    <?php /** @var Music[] $musics */
    foreach ($musics as $music) { ?>
        <tr>
            <th scope="row"><?= $music->id() ?></th>
            <td><?= $music->title() ?></td>
            <td><?= $music->artist() ?></td>
            <td><a href="<?= $music->url() ?>"><?= $music->url() ?></a></td>
            <td><?= $music->timecode() ?></td>
        </tr>
    <?php } ?>

    </tbody>
</table>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Libellé</th>
    </tr>
    </thead>
    <tbody>

    <?php
    /** @var \App\Models\Tag[] $tags */
    foreach ($tags as $tag) { ?>
        <tr>
            <th scope="row"><?= $tag->id() ?></th>
            <td><?= $tag->name() ?></td>
        </tr>
    <?php } ?>

    </tbody>
</table>
<?php
include 'App/Views/Layouts/footer.php';
?>