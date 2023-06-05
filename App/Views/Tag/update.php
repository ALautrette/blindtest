<?php
    include 'App/Views/Layouts/head.php';
    ?>
<form method="POST" action="<?='/tags/' . $tag->id() . '/update'?>">
    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" class="form-control" name="name" placeholder="Rock">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
        include 'App/Views/Layouts/footer.php';
    ?>