<?php

namespace App\Aquerai\Http;

class HttpHeader {
    private static $allowedOrigins = [
        'http://localhost:5500',
        'http://127.0.0.1:5500'
    ];

    public static function setDefaultHeaders() {

        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
        if (in_array($origin, self::$allowedOrigins)) {
            header("Access-Control-Allow-Origin: $origin");
        } else {
            header("Access-Control-Allow-Origin: " . self::$allowedOrigins[0]);
        }

        date_default_timezone_set('America/Sao_Paulo');
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        header("Access-Control-Allow-Credentials: true");
    }
}