<?php ?>

<section class="min-vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body px-sm-5 py-sm-4 text-center">

                        <div class="mt-md-3 pb-5">

                            <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
                            <form action="/register" method="post">

                                <div class="form-outline form-white mb-2">
                                    <input placeholder="Username" name="username" type="username" id="typeUserName" class="form-control form-control-lg" required/>
                                </div>

                                <div class="form-outline form-white mb-2">
                                    <input placeholder="Email" name="email" type="email" id="typeEmail" class="form-control form-control-lg" required/>
                                </div>

                                <div class="form-outline form-white mb-2">
                                    <input placeholder="Password" name="password" type="password" id="typePassword" class="form-control form-control-lg" required/>
                                </div>

                                <button class="btn btn-outline-light btn-lg w-100" type="submit">Register</button>
                                <?php if (isset($message)) : ?>
                                    <p><?= $message ?></p>
                                <?php endif; ?>
                            </form>
                        </div>


                        <div>
                            <p class="mb-0">Already have an account? <a href="/login" class="text-white-50 fw-bold">Sign
                                    In</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
