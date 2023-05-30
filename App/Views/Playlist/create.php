<?php
include 'App/Views/Layouts/BackOfficeMenu.php';
include 'App/Views/Layouts/head.php';
?>
<form method="POST" action="/playlists/create">
    <div class="form-group">
        <label for="">Nom de la playlist</label>
        <input type="text" class="form-control" name="name" placeholder="Nom playlist">
    </div>

    <div class="form-check">
        <label class="form-check-label" for="exampleCheck1">Public</label>
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="is_public">
    </div>
    <div class="row">
        <div class="col">
            <div id="containerM" style="width: 75%">
                <label for="selectM">Musiques</label>
                <select class="form-control" id="selectM" name="musics[0]">
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
            <button id="addM" type="button" class="btn btn-secondary">Ajouter une musique</button>
        </div>
        <div class="col">
            <div id="containerT" style="width: 50%">
                <label for="selectT">Tags</label>
                <select class="form-control" id="selectT" name="tags[0]">
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
            <button id="addT" type="button" class="btn btn-info">Ajouter un tag</button>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>


</form>


<script>

    const addM = document.getElementById('addM');
    addM.addEventListener("click", addMusic);
    let compteurM = 1;

    const addT = document.getElementById('addT');
    addT.addEventListener("click", addTag);
    let compteurT = 1;

    function addMusic() {
        let select = document.getElementById("selectM");
        let clone = select.cloneNode(true);
        clone.setAttribute('name', 'musics[' + compteurM + ']');
        let container = document.getElementById('containerM');
        container.appendChild(clone);
        compteurM++;
        if (compteurM >= 20) {
            addM.remove();
        }
    }

    function addTag() {
        let select = document.getElementById("selectT");
        let clone = select.cloneNode(true);
        clone.setAttribute('name', 'tags[' + compteurT + ']');
        let container = document.getElementById('containerT');
        container.appendChild(clone);
        compteurT++;
        if (compteurT > 3) {
            addT.remove();
        }
    }
</script>
<?php
include 'App/Views/Layouts/footer.php';
?>