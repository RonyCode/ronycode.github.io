<?php

namespace App\Educar\Controller;

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoUsers;
use App\Educar\Model\Usuario;

class SaveLoginController extends HtmlRenderController implements InterfaceStartProcess
{
    private PdoRepoUsers $repoUsers;

    public function __construct()
    {
        $pdo = ConnectionFactory::createConnection();
        $this->repoUsers = new PdoRepoUsers($pdo);
    }

    public function startProcess(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

        if (is_null($email) && is_null($senha) && $email === false && $senha === false) {
            echo 'E-mail e senha inválidos';
            return;
        }


        $user = new Usuario(null, $email, $senha);
        $userLoginCreated = $this->repoUsers->saveUser($user);
        if ($userLoginCreated === false || is_null($userLoginCreated)) {
            echo 'usuário já cadastrado';
            return;
        }

        header('location: /formulario-login', false, 302);

    }
}
