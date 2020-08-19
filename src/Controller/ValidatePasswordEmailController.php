<?php

namespace App\Educar\Controller;

use App\Educar\Helper\FlashMessageTrait;
use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoEmail;
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
        $response = new Response(302, ['Location' => '/login']);

        if (!isset($_GET['hash'])) {
            $this->definyMessage(
                'danger',
                'Erro com link '
            );
            unset($_SESSION['hash_valida']);
            return $response;
        }

        $hash = filter_var(
            $request->getQueryParams()['hash']
        );

        $hash = str_replace(' ', '+', $hash);
        if ($hash !== $_SESSION['hash_valida']) {
            $this->definyMessage(
                'danger',
                'Houve um problema com o link acessado, por favor tente novamente'

            );
            unset($_SESSION['hash_valida']);
            return $response;
        }

        return new Response(302, ['Location' => '/recadastra-senha']);
    }
}
