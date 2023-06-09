<?php
include 'App/Views/Layouts/BackOfficeMenu.php';
include 'App/Views/Layouts/head.php';
?>
    <a href="/games">
        <i class="fa-solid fa-arrow-left" style="font-size: 40px; margin: 10px 0 0 10px"></i>
    </a>
    <section class="container my-5 bg-dark" style="max-width: 1000px;margin:auto;border-radius: 1rem;">
        <div class="text-white p-3">
            <form method="POST" action="<?= '/games/' . $game->id() . '/update' ?>">
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
        </div>
    </section>
<?php
include 'App/Views/Layouts/footer.php';
?>