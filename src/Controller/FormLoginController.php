<?php

namespace App\Educar\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormLoginController extends HtmlRenderController implements RequestHandlerInterface
{


    public function handle($request): ResponseInterface
    {
        $html = $this->renderHtml('login/formulario.php', [
            'tittleDoc' => $tittleDoc = 'Login | Usuário',
            'tittle' => $tittle = 'Iniciar Login'
        ]);
        return new Response(202, [], $html);
    }
}
