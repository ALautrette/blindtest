<?php
include 'App/Views/Layouts/head.php';
include 'App/Views/Layouts/BackOfficeMenu.php';
?>
    <a href="/tags">
        <i class="fa-solid fa-arrow-left" style="font-size: 40px; margin: 10px 0 0 10px"></i>
    </a>
    <section class="container my-5 bg-dark" style="max-width: 1000px;margin:auto;border-radius: 1rem;">
        <div class="text-white p-3">
            <form method="POST" action="<?= /** @var \App\Models\Tag $tag */
            '/tags/' . $tag->id() . '/update' ?>">
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" class="form-control" name="name" value="<?= $tag->name() ?>">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
    </section>
<?php
include 'App/Views/Layouts/footer.php';
?>