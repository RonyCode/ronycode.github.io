<?php

namespace App\Educar\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormCreateLoginController extends HtmlRenderController implements
    RequestHandlerInterface
{
    public function handle($request): ResponseInterface
    {
        $tittle = 'Cadastrar usuário';
        $tittleDoc = 'Cadastro | Login';

        $html = $this->renderHtml('/login/formulario-cadastrar-login.php', [
            'tittle' => ($tittle = 'Cadastrar usuário'),
            'tittleDoc' => ($tittleDoc = 'Cadastro | Login'),
        ]);
        return new Response(202, [], $html);
    }
}
