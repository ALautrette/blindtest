<?php

use App\Models\User;
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th scope="col">Admin</th>
    </tr>
  </thead>
  <tbody>

    <?php /** @var User[] $users */
    foreach ($users as $user) { ?>
      <tr>
        <th scope="row"><?= $user->id() ?></th>
        <td><?= $user->username() ?></td>
        <td><?= $user->email() ?></td>
        <td><?= $user->password() ?></td>
        <td><?= $user->isAdmin() ?></td>
      </tr>
    <?php } ?>

  </tbody>
</table>