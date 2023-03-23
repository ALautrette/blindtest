<?php

use App\Models\Playlist;
use App\Models\User;

require_once 'App/Views/Layouts/BackOfficeMenu.php';
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Créateur</th>
      <th scope="col">Publique</th>
    </tr>
  </thead>
  <tbody>

    <?php /** @var Playlist[] $playlists */
    foreach ($playlists as $playlist) { ?>
      <tr>
        <th scope="row"><?= $playlist->id() ?></th>
          <td><?= $playlist->name() ?></td>
          <td><?= $playlist->userId() ?></td>
          <td><?= $playlist->isPublic() ?></td>
      </tr>
    <?php } ?>

  </tbody>
</table>