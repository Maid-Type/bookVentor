<header class="header">
    <h1>Book Inventory</h1>
    <nav class="nav">
        <a href="/" class="nav-link">Home</a>
        <a href="/books" class="nav-link">Books</a>
        <a href="/books/show" class="nav-link">Add Book</a>
        <?php if(isset($_SESSION['user_id'])) : ?>
        <a href="/logout" class="nav-link">Logout</a>
        <?php else : ?>
        <a href="/login" class="nav-link">Login</a>
        <a href="/register" class="nav-link">Register</a>
        <?php endif; ?>
    </nav>
</header>