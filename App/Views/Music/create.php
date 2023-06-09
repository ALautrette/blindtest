<?php
include 'App/Views/Layouts/BackOfficeMenu.php';
include 'App/Views/Layouts/head.php';
?>
    <a href="/musics">
        <i class="fa-solid fa-arrow-left" style="font-size: 40px; margin: 10px 0 0 10px"></i>
    </a>
    <section class="container my-5 bg-dark" style="max-width: 1000px;margin:auto;border-radius: 1rem;">
        <div class="text-white p-3">
            <form method="POST" action="/musics/create">
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
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
    </section>
<?php
include 'App/Views/Layouts/footer.php';
?>