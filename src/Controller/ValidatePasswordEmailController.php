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

class ValidatePasswordEmailController implements RequestHandlerInterface
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
        $email = filter_var(
            $request->getParsedBody()['email'],
            FILTER_SANITIZE_EMAIL
        );
     
        if (is_null($email) || $email === false && empty($email)) {
            return new Response(302, ['Location' => '/login']);
        }

        $usuario = new Usuario(null, $email, '');
        $validate = $this->repo->validateUpdatePassword($usuario);

        if (is_null($validate) && $validate === false) {
            $this->definyMessage(
                'danger',
                'Houve um problema por favor tente novamente'
            );
            return new Response(302, ['Location' => '/login']);
        } else {
            $_SESSION['logado'] = true;
            return new Response(302, ['Location' => '/recadastra-password']);
        }
    }
}