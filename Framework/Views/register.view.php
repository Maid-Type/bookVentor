<?php

loadpartial('head');
loadpartial('navbar');

?>

<section id="login" class="login-section">
    <form class="login-form" action="/register" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?= $username ?? null ?>" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit" class="action-button">Register</button>
    </form>
</section>

<?php

loadpartial('footer');

?>
