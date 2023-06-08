<?php

use App\Models\User;

include 'App/Views/Layouts/BackOfficeMenu.php';
include 'App/Views/Layouts/head.php';

?>
<section style="max-width: 1000px;margin:auto">
<a href="/users/create" class="btn btn-primary my-3">Create a user</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th scope="col">Admin</th>
      <th scope="col">Actions</th>
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
          <td>
              <a href="/users/<?= $user->id() ?>/update" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
              <a href="/users/<?= $user->id() ?>/delete" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
          </td>
      </tr>
    <?php } ?>

  </tbody>
</table>
</section>
<?php
include 'App/Views/Layouts/footer.php';
?>