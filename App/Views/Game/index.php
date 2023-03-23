<?php

use App\Models\Game;
use App\Models\User;

require_once 'App/Views/Layouts/BackOfficeMenu.php';
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Playlist</th>
        <th scope="col">Hôte</th>
        <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>

    <?php /** @var Game[] $games */
    foreach ($games as $game) { ?>
      <tr>
        <th scope="row"><?= $game->id() ?></th>
        <td><?= $game->playlistId() ?></td>
        <td><?= $game->userId() ?></td>
        <td><?= $game->date() ?></td>
      </tr>
    <?php } ?>

  </tbody>
</table>