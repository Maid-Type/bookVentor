<?php

namespace Framework\Controllers;

use Framework\ErrorHandler;
use Framework\Model\Database;

class ActionsController {
    protected $db;
    public function __construct() {
        $config = require getPath() . "helpers/config.php";
        $this->db = new Database($config);
    }

    public function show() {
        loadview('createBook',['operation' => 'Add a New Book','action' => '/books/create','method' => 'POST','submit' => "Add Book"]);
    }

    public function showEdit() {
        $segments = explode('/', trim($_SERVER["REQUEST_URI"], '/'));
        if ($_SERVER["REQUEST_METHOD"] === "GET" && is_int((int) ($segments[2]))) {
            $params = [
                'id' => $segments[2],
            ];
            $book = $this->db->query('SELECT * FROM inventory WHERE id = :id',$params);
            loadview('createBook',['operation' => 'Edit!','book' => $book[0],'action' => '/books/edit','method' => 'POST','submit' => "Save Book Edit"]);
        }
    }

    public function create() {
        $title = $_POST['title'] ?? null;
        $author = $_POST['author'] ?? null;
        $genre = $_POST['genre'] ?? null;
        $publishedYear = (int) ($_POST['publishedYear'] ?? null);
        $user_id = $_SESSION['user_id'] ?? null;

        $params = [
            'title' => $title,
            'author' => $author,
        ];


        $books = $this->db->query('SELECT * FROM inventory WHERE title = :title AND author = :author',$params);

        if ($books) {
            $error = 'This book already exists!';
            loadview('createBook', ['error' => $error]);
            exit;
        }

        $params = [
            'title' => $title,
            'author' => $author,
            'genre' => $genre,
            'publishedYear' => $publishedYear,
            'user_id' => $user_id,
        ];

        $this->db->query('INSERT INTO inventory(title,author,genre,publishedYear,user_id) VALUES(:title,:author,:genre,:publishedYear,:user_id)',$params);
        header('Location: /books');
        exit;
    }

    public function edit() {
        $title = htmlspecialchars($_POST['title'] ?? null);
        $author = htmlspecialchars($_POST['author'] ?? null);
        $genre = htmlspecialchars($_POST['genre'] ?? null);
        $publishedYear = (int) ($_POST['publishedYear'] ?? 0);
        $id = $_POST['ID'];

        $params = [
            'id' => $id,
        ];

        $book = $this->db->query('SELECT * FROM inventory WHERE id = :id', $params);

        if ($book) {
            $updateParams = [
                'genre' => $genre,
                'publishedYear' => $publishedYear,
                'title' => $title,
                'author' => $author,
                'id' => $id,
            ];
            $this->db->query(
                'UPDATE inventory SET title = :title,author = :author,genre = :genre, publishedYear = :publishedYear WHERE id = :id',$updateParams);
            header('Location: /books');
        } else {
            echo 'Book does not exist!';
        }
    }

    public function delete() {
        $segments = explode('/', trim($_SERVER["REQUEST_URI"], '/'));
        $id = $segments[2];


        $params = [
            'id' => $id,
        ];

        $book = $this->db->query('SELECT * FROM inventory WHERE id = :id',$params);
        if ($book) {
            $this->db->query('DELETE FROM inventory WHERE id = :id',$params);
            header('Location: /books');
        } else {
          ErrorHandler::notFound();
        }
    }
}