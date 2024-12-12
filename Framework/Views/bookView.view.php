<?php

    loadpartial('head');
    loadpartial('navbar');
    if (!isset($_SESSION['user_id'])) {
        header('Location: /login');
        exit();
    }

?>

<section id="books" class="books-section">
    <h2>Book Details</h2>
    <div class="book-list">
            <div class="book-card">
                <h3><?= $book[0]['title'] ?></h3>
                <p>Author: <?= $book[0]['author'] ?></p>
                <p>Genre: <?= $book[0]['genre'] ?></p>
                <p>Published Year: <?= $book[0]['publishedYear'] ?></p>
                <button class="action-button"><a href="/books/edit/<?= $book[0]['ID'] ?>">Edit</a></button>
                <button class="action-button"><a href="/books/delete/{id}">Delete</a></button>
            </div>
    </div>
</section>

<?php loadpartial('footer'); ?>