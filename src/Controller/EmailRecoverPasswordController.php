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

class EmailRecoverPasswordController implements RequestHandlerInterface
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
        $email1 = filter_var(
            $request->getParsedBody()['email'],
            FILTER_SANITIZE_EMAIL
        );
        $email2 = filter_var(
            $email1,
            FILTER_VALIDATE_EMAIL
        );

        $usuario = new Usuario(null, $email2, '');
        $validate = $this->repo->verifyAndAddHashPassword($usuario);


        if ($validate === false) {
            $this->definyMessage('danger', 'E-mail não encontrado');
            return new Response(
                302, ['Location' => '/recupera-senha-form']
            );
        } else {
            $this->definyMessage(
                'success',
                'Senha enviada com sucesso, por favor confirme os dados em seu e-mail informado'
            );
        }
        return new Response(200, ['Location' => ' /login']);
    }
}