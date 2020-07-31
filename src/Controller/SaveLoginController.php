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


        $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);


        if (is_null($email) && is_null($senha) && $email === false && $senha === false) {
            echo 'E-mail e senha inválidos';
            return;
        }


        $user = new Usuario(null, $usuario, $email, $senha);

        $userLogin = $this->repoUsers->saveUser($user);
        if ($userLogin === false || is_null($userLogin)) {
            echo 'usuário ou email já cadastrado';
            return;
        }

        header('location: /login', false, 302);

    }
}
