<?php
include 'App/Views/Layouts/head.php';
include 'App/Views/Layouts/BackOfficeMenu.php';
?>
<a href="/profile">
    <i class="fa-solid fa-arrow-left" style="font-size: 40px; margin: 10px 0 0 10px"></i>
</a>
    <section class="container my-5 bg-dark" style="max-width: 1000px;margin:auto;border-radius: 1rem;">
        <div class="text-white p-3">
            <div>
                <form method="POST" action="/users/search">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" name="username">
                    <button class="btn btn-primary mt-1" type="submit">Search</button>
                </form>
            </div>
        </div>
    </section>

<?php
include 'App/Views/Layouts/footer.php';
?>