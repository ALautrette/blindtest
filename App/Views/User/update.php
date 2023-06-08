<?php
include 'App/Views/Layouts/head.php';
?>
    <section class="container my-5 bg-dark" style="max-width: 1000px;margin:auto;border-radius: 1rem;">
        <div class="text-white p-3">
            <form method="POST" action="<?= '/users/' . $user->id() . '/update' ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email">
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="exampleCheck1">Administrateur ?</label>
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="is_admin">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
<?php
include 'App/Views/Layouts/footer.php';
?>