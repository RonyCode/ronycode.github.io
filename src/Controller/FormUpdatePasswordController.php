<?php

// session_unset();
// session_destroy();

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
        if (!isset($_SESSION['logado']) && !isset($_SESSION['usuario'])) {
            $this->definyMessage(
                'danger',
                'houve um erro com o link informado, por favor tente novamente a recuperação de senha.'
            );
            return new Response(302, ['Location' => '/logout']);
        }
        $this->definyMessage(
            'warning',
            'Caro usuário, por motivos de segurança essa pagina sera bloqueada em 30 segundos'
        );
        header('refresh:30; url=http://localhost/logout');

        $tittle = 'Insira nova senha';
        $tittleDoc = 'Nova senha';
        $html = $this->renderHtml('login/formulario-recadastra-senha.php', [
            'tittle' => $tittle,
            'tittleDoc' => $tittleDoc,
        ]);
        return new Response(302, [], $html);
    }
}
