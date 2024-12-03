<?php

namespace App\Aquerai\Model;

class UserModel {
    private string $userName;
    private string $userEmail;
    private string $birthDate;
    private string $cellPhone;
    private string $userPassword;


    public function setUserName($userName): void {
        $this->userName = $userName;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function setUserEmail($userEmail): void {
        $this->userEmail = $userEmail;
    }

    public function getUserEmail(): string {
        return $this->userEmail;
    }

    public function setBirthDate($birthDate): void {
        $this->birthDate = $birthDate;
    }

    public function getBirthDate(): string {
        return $this->birthDate;
    }

    public function setCellPhone($cellPhone): void {
        $this->cellPhone = $cellPhone;
    }

    public function getCellPhone(): string {
        return $this->cellPhone;
    }

    public function setUserPassword($userPassword): void {
        $this->userPassword = $userPassword;
    }

    public function getUserPassword(): string {
        return $this->userPassword;
    }
}