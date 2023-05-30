<?php
include 'App/Views/Layouts/BackOfficeMenu.php';
?>

<form method="POST" action="<?='/musics/' . $music->id() . '/update' ?>">
    <div class="form-group">
        <label for="url">Url</label>
        <input type="text" class="form-control" name="url" placeholder="youtube.com/exemple">
    </div>
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control" name="title" placeholder="Titre">
    </div>
    <div class="form-group">
        <label for="artist">Artiste</label>
        <input type="text" class="form-control" name="artist" placeholder="Artiste">
    </div>
    <div class="form-group">
        <label for="timecode">Timecode</label>
        <input type="number" class="form-control" name="timecode" placeholder="En secondes">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
include 'App/Views/Layouts/footer.php';
?>