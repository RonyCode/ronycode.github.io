<?php

use App\Educar\Controller\InterfaceStartProcess;
use App\Educar\Infrastructure\Persistence\ConnectionFactory;

require __DIR__ . '/../vendor/autoload.php';

ConnectionFactory::createConnection();

$getUrl = $_SERVER['PATH_INFO'];
$routes = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($getUrl, $routes)) {
    header('Location: /error');
    exit();
}

if (session_status() !== PHP_SESSION_ACTIVE) {//Verificar se a sessão não já está aberta.
    session_start();
}


//if (!$_SESSION['usuario']) {
//    header('Location: /formulario-login');
//}
$classControladora = $routes[$getUrl];
/** @var InterfaceStartProcess $controlador */
$controlador = new $classControladora();
$controlador->startProcess();
