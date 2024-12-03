<?php 

namespace App\Aquerai\Routes;

use App\Aquerai\Controller\UserController;

class Routes{
    public static function fastRoutes() {
        return [
            'POST' => [
                '/users' => [UserController::class, 'postUser'],
                '/login' => [UserController::class, 'postLogin'],
            ],
        ];
    }
}