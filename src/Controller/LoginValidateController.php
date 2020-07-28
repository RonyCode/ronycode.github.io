<?php


namespace App\Educar\Controller;


use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoUsers;

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
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

        if (is_null($email) && is_null($senha) && $email === false && $senha === false) {
            echo 'E-mail e senha inválidos';
            return;
        }

        $user = $this->repoUsers->login($email, $senha);


        if ($user === false || is_null($user)) {
            header('Location: /formulario-login');
        } else {
            header('Location: /listar-alunos', false, 302);
        }

        $_SESSION['usuario'] = true;

    }
}
