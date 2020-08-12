<?php

use App\Educar\Controller\{ErrorController,
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
    EmailRecoverPasswordController,
    RemoveController,
    SaveLoginController,
    UpdatePasswordController,
    ValidatePasswordEmailController
};

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
    '/recadastra-password' => FormUpdatePasswordController::class,
    '/valida-senha' => ValidatePasswordEmailController::class,
    '/nova-senha' => UpdatePasswordController::class,
];

return $routes;
