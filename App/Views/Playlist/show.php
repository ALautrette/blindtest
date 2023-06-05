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
<form method="POST" action="/playlists/<?= $playlist->id()?>/update">
    <div class="row">
        <div class="col">


            <div id="containerM" style="width: 75%">
                <label for="selectM">Musiques</label>


                <?php
                /** @var \App\Models\Music[] $musicsPlaylist */
                foreach ($musicsPlaylist

                         as $musicPlaylist) {
                    ?>
                    <div class="row">
                        <div class="col">
                            <p class='form-control'> <?= $musicPlaylist->title() ?></p>
                        </div>
                        <div class="col">
                            <a href="/playlists/<?= $playlist->id() ?>/music/delete/<?= $musicPlaylist->id() ?>"
                               class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <select class="form-control" id="selectM" name="musics[0]" style="display: none">
                        <?php
                        /** @var \App\Models\Music[] $musics */
                        foreach ($musics as $music) {
                            $id = $music->id();
                            $title = $music->title();

                            echo "<option value='$id'>$title</option>";
                        }
?>
                    </select>


                </div>
            </div>

            <button id="addM" type="button" class="btn btn-secondary">+</button>
        </div>
        <div class="col">

            <div id="containerT" style="width: 50%">

                <label for="selectT">Tags</label>
                <?php

                /** @var \App\Models\Tag[] $tagsPlaylist */
                foreach ($tagsPlaylist as $tagPlaylist) {
                    ?>
                    <div class="row">
                        <div class="col">
                            <p class='form-control'> <?= $tagPlaylist->name() ?></p>
                        </div>
                        <div class="col">
                            <a href="/playlists/<?= $playlist->id() ?>/tag/delete/<?= $tagPlaylist->id() ?>"
                               class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                <?php } ?>
                <select class="form-control" id="selectT" name="tags[0]" style="display: none">
                    <?php
                    /** @var \App\Models\Tag[] $tags */
                    foreach ($tags as $tag) {
                        $id = $tag->id();
                        $title = $tag->name();
                        echo "<option value='$id'>$title</option>";
                    }
?>
                </select>
            </div>

            <button id="addT" type="button" class="btn btn-info">+</button>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<script>

    const addM = document.getElementById('addM');
    addM.addEventListener("click", addMusic);
    let compteurM = 0;

    const addT = document.getElementById('addT');
    addT.addEventListener("click", addTag);
    let compteurT = 0;

    function addMusic() {
        console.log(compteurM)
        let select = document.getElementById("selectM");
        if (compteurM == 0) {
            select.style.display = "block";
        } else {
            let clone = select.cloneNode(true);
            clone.setAttribute('name', 'musics[' + compteurM + ']');
            let container = document.getElementById('containerM');
            container.appendChild(clone);
        }

        compteurM++;

        if (compteurM >= 20) {
            addM.remove();
        }
    }

    function addTag() {
        let select = document.getElementById("selectT");
        if (compteurT == 0) {
            select.style.display = "block";
        } else {
            let clone = select.cloneNode(true);
            clone.setAttribute('name', 'tags[' + compteurT + ']');
            let container = document.getElementById('containerT');
            container.appendChild(clone);
        }
        compteurT++;
        if (compteurT > 3) {
            addT.remove();
        }
    }
</script>

<?php
include 'App/Views/Layouts/footer.php';
?>

