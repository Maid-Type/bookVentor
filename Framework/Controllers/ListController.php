<?php

namespace Framework\Controllers;

use Framework\ErrorHandler;
use Framework\Model\Database;

class ListController {
    protected $db;
    public function __construct() {
        $config = require getPath() . "helpers/config.php";
        $this->db = new Database($config);
    }
    public function index() {

        $books = $this->db->query("SELECT * FROM inventory WHERE user_id = :id",['id' => $_SESSION['user_id'] ?? null]);

        loadview('bookList',['books' => $books]);
    }

    public function show() {
        $uri = $_SERVER['REQUEST_URI'];
        $parts = explode('/', $uri);

        $bookId = filter_var($parts[2], FILTER_VALIDATE_INT);
        if ($bookId === false) {
            http_response_code(400);
            echo "Invalid book ID.";
            return;
        }

        try {
            $book = $this->db->query('SELECT * FROM inventory WHERE id = :id', ['id' => $bookId]);
        } catch (\Throwable $e) {
            ErrorHandler::handleException($e);
        }

        if (empty($book)) {
            loadview('error');
            return;
        }

        loadview('bookView', ['book' => $book]);
    }

}