<?php

use App\Educar\Controller\{FormEditController,
    ErrorController,
    FormInsertController,
    FormLoginController,
    HomeController,
    ListAlunosController,
    PersistenceController,
    RemoveController,
    SaveLoginController
};

$routes = [
    '/home' => HomeController::class,
    '/login' => FormLoginController::class,
    '/listar-alunos' => ListAlunosController::class,
    '/novo-aluno' => FormInsertController::class,
    '/salvar-aluno' => PersistenceController::class,
    '/remover-aluno' => RemoveController::class,
    '/editar-aluno' => FormEditController::class,
    '/error' => ErrorController::class,
    '/salvar-login' => SaveLoginController::class
];

return $routes;
