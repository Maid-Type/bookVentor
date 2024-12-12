<?php

loadpartial('head');
loadpartial('navbar');

?>

<section id="books" class="books-section">
    <?php if (isset($_SESSION['user_id'])) : ?>
        <?php if (count($books) === 0) :  ?>
        <h1>Please add books to your empty inventory</h1>
        <?php else : ?>
        <h2>Book List</h2>
        <div class="book-list">
            <?php foreach ($books as $book) : ?>
                <div class="book-card">
                    <h3><?= htmlspecialchars($book['title']) ?></h3>
                    <p>Author: <?= htmlspecialchars($book['author']) ?></p>
                    <p>Genre: <?= htmlspecialchars($book['genre']) ?></p>

                    <div class="actions">
                        <a class="action-button" href="/books/<?= htmlspecialchars($book['ID']) ?>">Details</a>
                        <a class="action-button" href="/books/edit/<?= htmlspecialchars($book['ID']) ?>">Edit</a>
                        <form action="/books/delete/<?= htmlspecialchars($book['ID']) ?>" method="POST">
                            <button type="submit" class="action-button">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    <?php else: ?>
        <h1>Please Log In To View Books in Your Inventory!</h1>
    <?php endif; ?>
</section>

<?php loadpartial('footer'); ?>
