<?php

use App\Models\Tag;

include 'App/Views/Layouts/BackOfficeMenu.php';
include 'App/Views/Layouts/head.php';
?>
    <section style="max-width: 1000px;margin:auto">
        <a href="/tags/create" class="btn btn-primary my-3">Create a tag</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>

            <?php /** @var Tag[] $tags */
            foreach ($tags as $tag) { ?>
                <tr>
                    <th scope="row"><?= $tag->id() ?></th>
                    <td><?= $tag->name() ?></td>
                    <td>
                        <a href="/tags/<?= $tag->id() ?>/update" class="btn btn-primary"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        <a href="/tags/<?= $tag->id() ?>/delete" class="btn btn-danger"><i
                                    class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>

            </tbody>
        </table>
    </section>
<?php
include 'App/Views/Layouts/footer.php';
?>