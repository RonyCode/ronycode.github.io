<?php


use App\Educar\Controller\ErrorController;
use App\Educar\Controller\HomeController;
use App\Educar\Controller\ListStudantController;
use App\Educar\Controller\PersistenceController;

$routes = [
    '/home' => HomeController::class,
    '/listar-alunos' => ListStudantController::class,
    '/salvar-aluno' => PersistenceController::class,
    '/error' => ErrorController::class
];

return $routes;