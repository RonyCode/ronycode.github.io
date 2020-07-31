<?php

namespace App\Educar\Controller;

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoUsers;
use App\Educar\Model\Usuario;
use PDO;

session_start();

class LoginValidateController implements InterfaceStartProcess
{
    private PdoRepoUsers $repoUsers;

    public function __construct()
    {
        $pdo = ConnectionFactory::createConnection();
        $this->repoUsers = new PdoRepoUsers($pdo);
    }

    public function startProcess(): void
    {
        $userPost = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
        $senhaPost = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

        if (is_null($userPost) || $userPost === false) {
            echo 'Usuário inválidos';
            return;
        }

        $usuario = $this->repoUsers->login($userPost, $senhaPost);

        if (is_null($usuario) || $usuario === false) {
            echo 'E-mail ou senha incorretos';
            return;
        }

        header('location: /listar-alunos', false, 302);
    }
}
