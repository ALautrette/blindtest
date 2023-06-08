<?php
include 'App/Views/Layouts/head.php';
?>
    <section class="container my-5 bg-dark" style="max-width: 1000px;margin:auto;border-radius: 1rem;">
        <div class="text-white p-3">
            <form method="POST" action="<?= '/tags/' . $tag->id() . '/update' ?>">
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" class="form-control" name="name" placeholder="Rock">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
    </section>
<?php
include 'App/Views/Layouts/footer.php';
?>