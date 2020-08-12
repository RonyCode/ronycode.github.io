<?php


namespace App\Educar\Controller;


use App\Educar\Helper\FlashMessageTrait;
use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoUsers;
use Nyholm\Psr7\Response;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormUpdatePasswordController extends HtmlRenderController implements
    RequestHandlerInterface
{
    use FlashMessageTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $tittle = 'Insira nova senha';
        $tittleDoc = 'Nova senha';
        $html = $this->renderHtml(
            'login/formulario-recadastra-senha.php',
            [
                'tittle' => $tittle,
                'tittleDoc' => $tittleDoc
            ]
        );
        return new Response(302, [], $html);
    }
}