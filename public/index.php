<?php

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Http\Server\RequestHandlerInterface;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/config.php';

ConnectionFactory::createConnection();

$getUrl = $_SERVER['PATH_INFO'];
$routes = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($getUrl, $routes)) {
    header('Location: /error');
    exit();
}
session_start();

$rotaLogin = stripos($getUrl, 'login');

if (!isset($_SESSION['logado']) && $rotaLogin === false && $getUrl !== '/home' && $getUrl !== '/recupera-senha-form' && $getUrl !== '/recupera-senha') {
    header('Location: /login', false, 302);
    exit();
}

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory // StreamFactory
);

$request = $creator->fromGlobals();

$classControladora = $routes[$getUrl];
/** @var RequestHandlerInterface $controlador */
$controlador = new $classControladora();
$resposta = $controlador->handle($request);

foreach ($resposta->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $resposta->getBody();
