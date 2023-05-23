<div>
    <h1>Reset password</h1>
    <form action="/reset" method="post">

        <label for="email">
            Email
        </label>
        <input type="email" name="email" placeholder="Email" id="email" required>

        <input type="submit" value="Reset">
    </form>
    <?php if (isset($message)) : ?>
        <p><?= $message ?></p>
    <?php endif; ?>
</div>