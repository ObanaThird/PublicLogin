<?php

namespace App\Aquerai\Controller;

use App\Aquerai\Model\UserModel;
use App\Aquerai\Repository\UserRepository;

class UserController {
    public function postUser ($data): void {
        $userName = $data['userName'];
        $userPassword = $data['userPassword'];
        $userEmail = $data['userEmail'];
        $cellPhone = $data['cellPhone'];
        $birthDate = $data['birthDate'];

        $userModel = new UserModel();
        $userModel->setUserName($userName);
        $userModel->setUserPassword($userPassword);
        $userModel->setUserEmail($userEmail);
        $userModel->setCellPhone($cellPhone);
        $userModel->setBirthDate($birthDate);

        $userRepository = new UserRepository();
        $result = $userRepository->insertUser($userModel);

        if ($result) {
            http_response_code(200);
            echo json_encode($result);
        } else {
            http_response_code(500);
            echo json_encode($result);
        }      
    }

    public function postLogin ($data): void {
        $userEmail = $data['userEmail'];
        $userPassword = $data['userPassword'];

        $userModel = new UserModel();
        $userModel->setUserEmail($userEmail);
        $userModel->setUserPassword($userPassword);

        $userRepository = new UserRepository();
        $userRepository->login($userModel);
        
    }
}