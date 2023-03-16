<?php ?>

<div>
    <h1>Login</h1>
    <form action="/login" method="post">

        <label for="email">
            Email
        </label>
        <input type="email" name="email" placeholder="Email" id="email" required>

        <label for="password">
            Password
        </label>
        <input type="password" name="password" placeholder="Password" id="password" required>

        <input type="submit" value="Login">
    </form>
        <?php if (isset($message)) : ?>
            <p><?= $message ?></p>
        <?php endif; ?>
</div>
