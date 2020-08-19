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
        $reponse = new Response(302, ['Location' => '/login']);

        if (!isset($_POST['email']) || !isset($_POST['senha']) || !isset($_POST['senha_confere'])) {
            $this->definyMessage(
                'danger',
                'Houve um problema com o link tente novamente'
            );
            return $reponse;
        }
        $email = filter_var(
            $request->getParsedBody()['email'],
            FILTER_VALIDATE_EMAIL
        );

        $senha = filter_var(
            $request->getParsedBody()['senha'],
            FILTER_SANITIZE_STRING
        );
        $senhaConfere = filter_var(
            $request->getParsedBody()['senha_confere'],
            FILTER_SANITIZE_STRING
        );
        if (!isset($_SESSION['email_recover']) || $_SESSION['email_recover'] !== $email) {
            $this->definyMessage(
                'danger',
                'E-mail digitado não corresponde com e-mail do link enviado '

            );
            unset($_SESSION['email_recover']);
            return $reponse;
        }


        if (is_null($email) ||
            is_null($senha) ||
            is_null($senhaConfere) ||
            $email === false ||
            $senha === false ||
            $senhaConfere === false) {
            $this->definyMessage(
                'danger',
                'E - mail digitado não corresponde com e - mail do link enviado ou  senha digitada é invalida'
            );
            unset($_SESSION['email_recover']);
            return $reponse;
        }

        if ($senha !== $senhaConfere) {
            $_SESSION['senha_confere'] = true;
            $this->definyMessage(
                'danger',
                'A senha digitada não confere com a anterior, por favor acesse o link novamente'
            );
            return $reponse;
        }

        $usurario = new Usuario(null, $email, $senha);


        $usurarioEncontrado = $this->repo->findUser($usurario);
        $usurarioEncontrado->setSenha($senha);
        $novaSenha = $this->repo->saveUser($usurarioEncontrado);
        if ($novaSenha === false) {
            $this->definyMessage('danger', 'Usuário não encontrado');
            return new Response(302, ['Location' => ' /login']);
        }

        $this->definyMessage('success', 'Nova senha cadastrada com sucesso!');
        session_destroy();
        return new Response(302, ['Location' => ' /login']);
    }
}
