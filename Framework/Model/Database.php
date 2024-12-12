<?php

namespace Framework\Model;
use Framework\ErrorHandler;
use PDO;
use Throwable;

class Database
{
    private $db;
    public function __construct(array $config) {
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8;port={$config['port']};";

        try {
            $this->db = new PDO($dsn, $config['username'], $config['password']);
        } catch (Throwable $e) {
            ErrorHandler::handleException($e);
        }
    }

    public function getDb() {
        return $this->db;
    }

    public function query($sql,array $params = []) {
        $stmt = $this->db->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}