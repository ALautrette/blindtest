<?php
include 'App/Views/Layouts/head.php';
?>

<section class="min-vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body px-sm-5 py-sm-4 text-center">

                        <div class="mt-md-3 pb-5">

                            <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                            <p class="text-white-50">Please enter your email and password!</p>
                            <form action="/login" method="post">

                                <div class="form-outline form-white mb-2">
                                    <input placeholder="Email" name="email" type="email" id="typeEmail" class="form-control form-control-lg" required/>
                                </div>

                                <div class="form-outline form-white mb-2">
                                    <input placeholder="Password" name="password" type="password" id="typePassword" class="form-control form-control-lg" required/>
                                </div>

                                <p class="small pb-lg-2"><a class="text-white-50" href="/reset">Forgot password?</a>
                                </p>

                                <button class="btn btn-outline-light btn-lg w-100" type="submit">Login</button>
                                <?php if (isset($message)) : ?>
                                    <p><?= $message ?></p>
                                <?php endif; ?>
                            </form>
                        </div>


                        <div>
                            <p class="mb-0">Don't have an account? <a href="/register" class="text-white-50 fw-bold">Sign
                                    Up</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include 'App/Views/Layouts/footer.php';
?>