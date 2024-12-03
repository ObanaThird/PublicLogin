<?php

namespace App\Aquerai\Database;
use PDO;
use PDOException;

class DatabaseConnection {
    /*private $host = '127.0.0.1';
    private $db = 'aqueraiDB';
    private $user = 'root';
    private $pass = '123456';
    private $charset = 'utf8mb4';*/

    private $path;
    public function __construct() {
        $this->path = __DIR__ . '/aqueraiDB.sqlite';
    }

    public function getConnection(): PDO | string{
        try {
            $pdo = new PDO ("sqlite:$this->path");
            return $pdo;
        } catch (PDOException $e) {
            echo 'Erro ao conectar: ' . $e->getMessage();
        }
    }
}