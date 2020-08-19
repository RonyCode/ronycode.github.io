<?php


namespace App\Educar\Controller;

use App\Educar\Helper\FlashMessageTrait;
use App\Educar\Infrastructure\Repository\PdoRepoEmail;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FormUpdatePasswordController extends HtmlRenderController
{
    use FlashMessageTrait;

    private PdoRepoEmail $repo;


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (!isset($_SESSION['hash_valida'])) {
            var_dump($_SESSION['hash_valida']);
            $this->definyMessage('danger',
                'Essa página só pode ser acessada através do link, por favor tente novamente');
            unset($_SESSION['hash_valida']);
            header('Location: /login');
        }


        $tittle = 'Digite nova senha';
        $tittleDoc = 'Nova senha';
        $html = $this->renderHtml(
            'login/formulario-recadastra-senha.php',
            [
                'tittle' => $tittle,
                'tittleDoc' => $tittleDoc,
            ]
        );
        unset($_SESSION['hash_valida']);
        return new Response(302, [], $html);
    }
}
