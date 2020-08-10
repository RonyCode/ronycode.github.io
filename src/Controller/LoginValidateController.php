<?php

namespace App\Educar\Controller;

use App\Educar\Helper\FlashMessageTrait;
use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoUsers;
use App\Educar\Model\Usuario;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginValidateController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private PdoRepoUsers $repoUsers;

    public function __construct()
    {
        $pdo = ConnectionFactory::createConnection();
        $this->repoUsers = new PdoRepoUsers($pdo);
    }

    public function handle($request): ResponseInterface
    {
        $emailPost = filter_var(
            $request->getParsedBody()['email'],
            FILTER_SANITIZE_STRING
        );

        $senhaPost = filter_var(
            $request->getParsedBody()['senha'],
            FILTER_SANITIZE_STRING
        );



        $response = new Response(302, ['Location' => '/login']);

        if (is_null($emailPost) || $emailPost === false) {
            $this->definyMessage('danger', 'O usuário digitado não é valido');
            return $response;
        }
        $usuario = new Usuario(null, $emailPost, $senhaPost);

        $senha = $this->repoUsers->login($usuario);
        $usuario->senhaEstaCorreta($senha);

        if (is_null($senha) || $usuario->senhaEstaCorreta($senha) === false) {
            $this->definyMessage('danger', 'Insira senha válida');
            return $response;
        }
        $_SESSION['usuario'] = true;

        return new Response(302, ['Location' => '/listar-alunos']);
    }
}
