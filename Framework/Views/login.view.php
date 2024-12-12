<?php

loadpartial('head');
loadpartial('navbar');

?>

<section id="login" class="login-section">
    <?php if (isset($errors)) {
        foreach ($errors as $error) : ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endforeach;
    } ?>
    <form class="login-form" action="/login" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?= $username ?? null ?>" required placeholder="Username='user1'">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Password='password1'" required>
        <button type="submit" class="action-button">Login</button>
    </form>
</section>

<?php

loadpartial('footer');

?>
