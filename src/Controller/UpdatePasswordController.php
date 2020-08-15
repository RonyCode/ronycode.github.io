<?php

namespace App\Educar\Controller;

use App\Educar\Helper\FlashMessageTrait;
use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoUsers;
use App\Educar\Model\Usuario;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UpdatePasswordController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private PdoRepoUsers $repo;

    public function __construct()
    {
        $pdo = ConnectionFactory::createConnection();
        $this->repo = new PdoRepoUsers($pdo);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $senha = filter_var(
            $request->getParsedBody()['senha'],
            FILTER_SANITIZE_STRING
        );
        $senhaConfere = filter_var(
            $request->getParsedBody()['senha_confere'],
            FILTER_SANITIZE_STRING
        );

        $reponse = new Response(302, ['Location' => '/recadastra-password']);

        if (
            is_null($senha) ||
            is_null($senhaConfere) ||
            $senha === false ||
            $senhaConfere === false
        ) {
            $this->definyMessage('danger', 'A senha digitada é invalida');
            return $reponse;
        }

        if ($senha !== $senhaConfere) {
            $_SESSION['senha_confere'] = true;
            $this->definyMessage(
                'danger',
                'A senha digitada não confere com a anterior'
            );
            return $reponse;
        }

        $usurario = new Usuario(null, $_SESSION['usuario'], $senha);

        $usurarioEncontrado = $this->repo->findUser($usurario);
        $usurarioEncontrado->setSenha($senha);
        $novaSenha = $this->repo->saveUser($usurarioEncontrado);
        if ($novaSenha === false) {
            $this->definyMessage('danger', 'Usuário não encontrado');
            return new Response(302, ['Location' => '/logout']);
        }
        return new Response(302, ['Location' => '/login']);
    }
}
