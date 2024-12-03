<?php

namespace App\Aquerai\Database;
use App\Aquerai\Database\DatabaseConnection;


require '../../vendor/autoload.php';


class dbManagement {
    private $connection;
    public function __construct() {
        $databaseConnection = new DatabaseConnection();
        $this->connection = $databaseConnection->getConnection();
    }

    public function createUser(){
        $this->connection->exec('
        CREATE TABLE user
        (iduser INTEGER PRIMARY KEY,
        userName TEXT,
        userEmail TEXT,
        userPassword TEXT,
        cellPhone INTEGER,
        birthDate TEXT,
        saltPassword TEXT)');
    }
}
$create = new dbManagement();
$create->createUser();