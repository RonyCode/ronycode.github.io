<?php

use App\Educar\Controller\InterfaceStartProcess;
use App\Educar\Infrastructure\Persistence\ConnectionFactory;

require __DIR__ . '/../vendor/autoload.php';

ConnectionFactory::createConnection();

$getUrl = $_SERVER['PATH_INFO'];
$routes = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($getUrl, $routes)) {
    require __DIR__ . '/../src/View/Main/error.html.php';
    exit();
}

$classControladora = $routes[$getUrl];
/** @var InterfaceStartProcess $controlador */
$controlador = new $classControladora();
$controlador->startProcess();

