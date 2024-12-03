<?php

namespace App\Aquerai\Services;

use Firebase\JWT\JWT;

class AuthService {
    private $jwtConfig;

    public function __construct()
    {
        $this->jwtConfig = require __DIR__ . '/../config/jwt.php';
    }

    public function authenticate($res) {

        $payload = [
            'iss' => $this->jwtConfig['issuer'],
            'aud' => $this->jwtConfig['audience'],
            'iat' => time(),
            'exp' => time() + 3600,
            'userId' => $res['userName'],
            'email'=> $res['userEmail']
        ];

        $token = JWT::encode($payload, $this->jwtConfig['secret'], $this->jwtConfig['algorithm']);

        //echo "Token gerado no serviço: " . $token . PHP_EOL;

        return ['token' => $token];
    }
}