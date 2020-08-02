<?php

namespace App\Educar\Controller;

use App\Educar\Helper\FlashMessageTrait;
use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoUsers;
use App\Educar\Model\Usuario;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SaveLoginController extends HtmlRenderController implements RequestHandlerInterface
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


        $usuario = filter_var($request->getQueryParams()['usuario'],
            FILTER_SANITIZE_STRING);
        $email = filter_var($request->getParsedBody()['email'],
            FILTER_SANITIZE_STRING);
        $senha = filter_var($request->getParsedBody()['senha'],
            FILTER_VALIDATE_EMAIL);

        $resposta = new Response(302, ['Location' => '/login-cadastrar']);

        if (is_null($email) && is_null($senha) && $email === false && $senha === false) {
            $this->definyMessage('danger', 'Usuário ou senha não existe');
            return $resposta;

        }


        $user = new Usuario(null, $usuario, $email, $senha);

        $userLogin = $this->repoUsers->saveUser($user);
        if ($userLogin === false || is_null($userLogin)) {
            $this->definyMessage('danger', 'Erro ao cadastrar usuário');
            return $resposta;
        }
        $this->definyMessage('success', 'Usuário cadastrado com sucesso');

        return new Response(302, ['Location' => '/login']);
    }

}
