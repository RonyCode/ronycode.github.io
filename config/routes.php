<?php

use App\Educar\Controller\{EmailRecoverPasswordController,
    ErrorController,
    FormConfirmEmailController,
    FormCreateLoginController,
    FormEditController,
    FormInsertController,
    FormLoginController,
    FormRecoverPasswordController,
    FormUpdatePasswordController,
    HomeController,
    ListAlunosController,
    LoginValidateController,
    LogoutController,
    PersistenceController,
    RemoveController,
    SaveLoginController,
    UpdatePasswordController,
    ValidatePasswordEmailController};

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
    '/recupera-senha-form' => FormRecoverPasswordController::class,
    '/email-recupera-senha' => EmailRecoverPasswordController::class,
    '/confirma-senha' => ValidatePasswordEmailController::class,
    '/nova-senha' => UpdatePasswordController::class,
    '/recadastra-senha' => FormUpdatePasswordController::class,
];

return $routes;
