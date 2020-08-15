<?php

namespace App\Educar\Controller;

use App\Educar\Helper\FlashMessageTrait;
use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoEmail;
use App\Educar\Infrastructure\Repository\PdoRepoUsers;
use App\Educar\Model\Usuario;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ValidatePasswordEmailController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private PdoRepoEmail $repo;

    public function __construct()
    {
        $pdo = ConnectionFactory::createConnection();
        $this->repo = new PdoRepoEmail($pdo);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $email = filter_var(
            $request->getParsedBody()['email'],
            FILTER_SANITIZE_EMAIL
        );

        if (is_null($email) || ($email === false && empty($email))) {
            $this->definyMessage(
                'danger',
                'Houve um problema por favor tente novamente mais tarde'
            );
            return new Response(302, ['Location' => '/login']);
        }

        $usuario = new Usuario(null, $email, '');
        $validate = $this->repo->validateUpdatePassword($usuario);

        if ($validate === false) {
            $this->definyMessage(
                'danger',
                'Houve um problema com o link enviado para seu e-mail, por favor tente novamente com novo link'
            );
            return new Response(302, ['Location' => '/login']);
        } else {
            $_SESSION['logado'] = true;
            $_SESSION['usuario'] = $email;

            return new Response(302, ['Location' => '/recadastra-password']);
        }
    }
}
