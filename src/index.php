<?php

namespace App\Aquerai;

use App\Aquerai\Http\HttpHeader;
use App\Aquerai\Routes\Router;
use App\Aquerai\Routes\Routes;
use Dotenv\Dotenv;

require_once '../vendor/autoload.php';

$path = dirname(__FILE__,2);

$dotenv = Dotenv::createImmutable($path);
$dotenv->load();

HttpHeader::setDefaultHeaders();

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$arrayRoutes = Routes::fastRoutes();

Router::resolve($arrayRoutes, $method, $uri);
