<?php

namespace App\Aquerai\Routes;

class Router {
    public static function resolve(array $arrayRoutes, $method, $uri) {
        foreach ($arrayRoutes[$method] as $route => $controller) {
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $route);

            if (preg_match("#^$pattern$#", $uri, $recurso)) {
                array_shift($recurso);
                $controllerInstance = new $controller[0]();
                $data = json_decode(file_get_contents('php://input'), true);
                $reflection = new \ReflectionMethod($controllerInstance, $controller[1]);
                $parameters = $reflection->getParameters();
                $args = [];

                foreach ($parameters as $param) {
                    if ($param->getName() === 'data') {
                        $args[] = $data;
                    } elseif (!empty($recurso)) {
                        $args[] = array_shift($recurso);
                    } else {
                        $args[] = null;
                    }
                }

                return call_user_func_array([$controllerInstance, $controller[1]], $args);
            }
        }

        http_response_code(404);
        echo json_encode(['Status' => false, 'Message' => 'Endpoint não encontrado']);
        exit();
    }
}