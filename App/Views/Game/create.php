<?php
include 'App/Views/Layouts/BackOfficeMenu.php';
?>

<form method="POST" action="/games/create">
    <div class="form-group">
        <label for="date">Date</label>
        <input type="datetime-local" class="form-control" name="date" placeholder="Pick date">
    </div>
    <div class="form-group">
        <label for="playlist_id">Playlist liée</label>
        <select name="playlist_id">
            <?php foreach ($playlists as $playlist) { ?>
                <option value="<?= $playlist->id() ?>"><?= $playlist->name() ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="user_id">Hôte de la partie</label>
        <select name="user_id">
            <?php foreach ($users as $user) { ?>
                <option value="<?= $user->id() ?>"><?= $user->username() ?></option>
            <?php } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
include 'App/Views/Layouts/footer.php';
?>