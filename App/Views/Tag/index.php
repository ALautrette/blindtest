<?php

use App\Models\Tag;
use App\Models\User;

require_once 'App/Views/Layouts/BackOfficeMenu.php';
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
    </tr>
  </thead>
  <tbody>

    <?php /** @var Tag[] $tags */
    foreach ($tags as $tag) { ?>
      <tr>
        <th scope="row"><?= $tag->id() ?></th>
        <td><?= $tag->name() ?></td>
      </tr>
    <?php } ?>

  </tbody>
</table>