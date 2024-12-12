<?php

namespace Framework\Controllers;

use Framework\Model\Database;

class AuthController
{
    protected $db;

    public function __construct() {
        $config = require getPath() . "helpers/config.php";
        $this->db = new Database($config);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);

            $params = [
                'username' => $username
            ];

            $user = $this->db->query('SELECT ID, password_hash FROM users WHERE username = :username', $params);

            if ($user && password_verify($password, $user[0]['password_hash'])) {
                $_SESSION['user_id'] = $user[0]['ID'];

                header('Location: /books');
                exit();
            } else {
                $errors[] =  "Invalid username or password.";
                loadview('login', ['errors' => $errors]);
            }
        } else {
            loadview('login');
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $params = ['username' => $username];
            $existingUser = $this->db->query('SELECT username FROM users WHERE username = :username', $params);

            if ($existingUser) {
                echo "User already exists.";
                return;
            }

            $params = [
                'username' => $username,
                'password_hash' => $password
            ];

            $this->db->query("INSERT INTO users(username, password_hash) VALUES (:username, :password_hash)", $params);

            $newUser = $this->db->query('SELECT ID FROM users WHERE username = :username', ['username' => $username]);

            if ($newUser) {
                $_SESSION['user_id'] = $newUser[0]['ID'];

                header('Location: /books');
                exit();
            } else {
                echo "Error logging in after registration.";
            }
        } else {
            loadview('register');
        }
    }


    public function logout() {
        session_unset();
        session_destroy();

        header('Location: /login');
        exit();
    }
}