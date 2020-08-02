<?php

use App\Educar\Controller\{ErrorController,
    FormCreateLoginController,
    FormEditController,
    FormInsertController,
    FormLoginController,
    HomeController,
    ListAlunosController,
    LoginValidateController,
    LogoutController,
    PersistenceController,
    RemoveController,
    SaveLoginController};

$routes = [
    '/login' => FormLoginController::class,
    '/login-realizado' => LoginValidateController::class,
    '/login-salvar' => SaveLoginController::class,
    '/login-cadastrar' => FormCreateLoginController::class,
    '/logout' => LogoutController::class,
    '/home' => HomeController::class,
    '/listar-alunos' => ListAlunosController::class,
    '/novo-aluno' => FormInsertController::class,
    '/salvar-aluno' => PersistenceController::class,
    '/remover-aluno' => RemoveController::class,
    '/editar-aluno' => FormEditController::class,
    '/error' => ErrorController::class,
];

return $routes;
