<?php
include 'App/Views/Layouts/head.php';
include 'App/Views/Layouts/BackOfficeMenu.php';
?>
    <section class="container my-5 bg-dark" style="max-width: 1000px;margin:auto;border-radius: 1rem;">
        <div class="text-white p-3">
            <div>

                <form method="POST" action="/users/search">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" name="username">
                    <button class="btn-info" type="submit">Search</button>
                </form>
            </div>
        </div>
    </section>

<?php
include 'App/Views/Layouts/footer.php';
?>