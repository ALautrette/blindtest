<?php

use App\Models\Tag;

require_once 'App/Views/Layouts/BackOfficeMenu.php';
?>

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
          <a href="/tags/<?= $tag->id() ?>/update" class="btn btn-primary">Modifier</a>
          <a href="/tags/<?= $tag->id() ?>/delete" class="btn btn-danger">Supprimer</a>
        </td>
      </tr>
    <?php } ?>

  </tbody>
</table>