<?php

namespace App\Aquerai\Repository;

use App\Aquerai\Database\DatabaseConnection;
use App\Aquerai\Model\UserModel;
use App\Aquerai\Services\AuthService;
use PDO;

class UserRepository {
    private PDO $connection;

    public function __construct() {
        $database = new DatabaseConnection();
        $this->connection = $database->getConnection();
    }

    public function insertUser(UserModel $userModel):bool | string {
        $userName = $userModel->getUsername();
        $userPassword = $userModel->getUserPassword();
        $userEmail = $userModel->getUserEmail();
        $cellPhone = $userModel->getCellPhone();
        $birthDate = $userModel->getBirthDate();


        $salt = bin2hex(random_bytes(16));
        $saltedPassword = $salt . $userPassword;
        $hash = password_hash($saltedPassword, PASSWORD_DEFAULT);

        $pdoStmt = $this->connection->prepare("INSERT INTO user 
        (userName, userEmail, userPassword, cellPhone, birthDate, saltPassword) VALUES
        (:userName, :userEmail, :userPassword, :cellPhone, :birthDate, :saltPassword)");

        $pdoStmt->bindParam(":userName", $userName);
        $pdoStmt->bindParam(":userPassword", $hash);
        $pdoStmt->bindParam(":userEmail", $userEmail);
        $pdoStmt->bindParam(":cellPhone", $cellPhone);
        $pdoStmt->bindParam(":birthDate", $birthDate);
        $pdoStmt->bindParam(":saltPassword", $salt);

        try {
            if($pdoStmt->execute()){
                $rowsAffected = $pdoStmt->rowCount();
                return $rowsAffected > 0;
            }
        } catch(\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function login(UserModel $userModel) {    
        $userEmail = $userModel->getUserEmail();
        $userPassword = $userModel->getUserPassword();

        $selectStmt =  $this->connection->prepare("SELECT * FROM user WHERE userEmail = :userEmail");
        $selectStmt->bindParam(":userEmail", $userEmail);
        $selectStmt->execute();
        $res = $selectStmt->fetch();

        if($res){
            $salt = $res['saltPassword'];
            $saltedPassword = $salt . $userPassword;

            if (password_verify($saltedPassword, $res['userPassword'])){
                $authService = new AuthService();
                return $authService->authenticate($res);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}