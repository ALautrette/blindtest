<?php
include 'App/Views/Layouts/BackOfficeMenu.php';
include "App/Views/Layouts/head.php";
?>
    <a href="/musics">
        <i class="fa-solid fa-arrow-left" style="font-size: 40px; margin: 10px 0 0 10px"></i>
    </a>
    <section class="container my-5 bg-dark" style="max-width: 1000px;margin:auto;border-radius: 1rem;">
        <div class="text-white p-3">
            <form method="POST" action="<?= /** @var \App\Models\Music $music */
            '/musics/' . $music->id() . '/update' ?>">
                <div class="form-group">
                    <label for="url">Url</label>
                    <input type="text" class="form-control" name="url" value="<?=$music->url()?>">
                </div>
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" class="form-control" name="title" value="<?=$music->title()?>">
                </div>
                <div class="form-group">
                    <label for="artist">Artiste</label>
                    <input type="text" class="form-control" name="artist" value="<?=$music->artist()?>">
                </div>
                <div class="form-group">
                    <label for="timecode">Timecode</label>
                    <input type="number" class="form-control" name="timecode" value="<?=$music->timecode()?>">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
<?php
include 'App/Views/Layouts/footer.php';
?>