<form method="POST" action="/playlists/create">
    <div class="form-group">
        <label for="">Nom de la playlist</label>
        <input type="text" class="form-control" name="name" placeholder="Nom playlist">
    </div>

    <div class="form-check">
        <label class="form-check-label" for="exampleCheck1">Public ?</label>
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="is_public">
    </div>
    <div id="container">
        <select  class="form-select" id="select" name="musics[0]">
            <?php
            var_dump($musics);
            foreach ($musics as $music) {
                $id = $music->id();
                $title = $music->title();
                echo "<option value='$id'>$title</option>";
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>


</form>
<button id="add" type="button" class="btn btn-secondary">Ajouter une musique</button>
<script>

    const add = document.getElementById('add');
    add.addEventListener("click", addMusic);
    let compteur = 1;

    function addMusic() {
        let select = document.getElementById("select");
        let clone = select.cloneNode(true);
        clone.setAttribute('name', 'musics[' + compteur + ']');
        let container = document.getElementById('container');
        container.appendChild(clone);
        compteur++;
    }
</script>