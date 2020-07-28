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
    '/home' => HomeController::class,
    '/formulario-login' => FormLoginController::class,
    '/listar-alunos' => ListAlunosController::class,
    '/novo-aluno' => FormInsertController::class,
    '/salvar-aluno' => PersistenceController::class,
    '/remover-aluno' => RemoveController::class,
    '/editar-aluno' => FormEditController::class,
    '/error' => ErrorController::class,
    '/salvar-login' => SaveLoginController::class,
    '/formulario-cadastrar-login' => FormCreateLoginController::class,
    '/login-realizado' => LoginValidateController::class,
    '/logout' => LogoutController::class
];

return $routes;
