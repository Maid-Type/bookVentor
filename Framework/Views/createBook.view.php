<?php

loadpartial('head');
loadpartial('navbar');

?>

<section id="add-book" class="add-book-section">
    <?php if (isset($_SESSION['user_id'])) : ?>
        <?php if (isset($operation)) : ?>
            <h2>
                <?php echo htmlspecialchars($operation); ?>
            </h2>
        <?php endif; ?>
        <?php if (isset($error)) : ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <form class="add-book-form" action="<?php echo htmlspecialchars($action); ?>" method="<?php echo htmlspecialchars($method); ?>">
            <input type="hidden" name="ID" value="<?= htmlspecialchars($book['ID'] ?? '') ?>">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($book['title'] ?? '') ?>" required>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" value="<?= htmlspecialchars($book['author'] ?? '') ?>" required>
            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" value="<?= htmlspecialchars($book['genre'] ?? '') ?>" required>
            <label for="publishedYear">Published Year:</label>
            <input type="text" id="publishedYear" name="publishedYear" value="<?= htmlspecialchars($book['publishedYear'] ?? '') ?>" required>
            <button type="submit" class="submit-btn"><?= htmlspecialchars($submit) ?></button>
        </form>
    <?php else : ?>
        <h1>Please Log In to Add or Edit Books in Your Inventory!</h1>
    <?php endif; ?>
</section>

<?php

loadpartial('footer');

?>
