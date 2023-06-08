<?php
include 'App/Views/Layouts/head.php';
include 'App/Views/Layouts/BackOfficeMenu.php';
?>

    <div>

        <form method="POST" action="/users/search">
            <label for="username">Pseudo</label>
            <input class="form-control" type="text" name="username">
            <button class="btn-info" type="submit">Rechercher</button>
        </form>
    </div>

<?php
include 'App/Views/Layouts/footer.php';
?>