<div>
    <h1>Enter your new password</h1>
    <form action="/newpassword" method="post">
        <?php echo $user->id() ?>
        <input type="text" name="userId" value="<?php echo $user->id() ?>" hidden />
        <label for="password">
            Password
        </label>
        <input type="password" name="password" placeholder="Password" id="password" required>

        <input type="submit" value="Reset">
    </form>
    <?php if (isset($message)) : ?>
        <p><?= $message ?></p>
    <?php endif; ?>
</div>