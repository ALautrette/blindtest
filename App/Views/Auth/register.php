<?php ?>

<div>
    <h1>Register</h1>
    <form action="/register" method="post">

        <label for="username">
            Username
        </label>
        <input type="text" name="username" placeholder="Username" id="username" required>

        <label for="email">
            Email
        </label>
        <input type="email" name="email" placeholder="Email" id="email" required>

        <label for="password">
            Password
        </label>
        <input type="password" name="password" placeholder="Password" id="password" required>

        <input type="submit" value="Register">
    </form>
        <?php if (isset($message)) : ?>
            <p><?= $message ?></p>
        <?php endif; ?>
</div>
