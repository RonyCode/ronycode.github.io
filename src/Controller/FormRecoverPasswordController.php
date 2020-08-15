<?php

namespace App\Educar\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormRecoverPasswordController extends HtmlRenderController implements
    RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $tittleDoc = 'Email | Recuperar senha';
        $tittle = 'E-mail de recuperação de senha';
        $html = $this->renderHtml('login/formulario-recupera-senha-email.php', [
            'tittle' => $tittle,
            'tittleDoc' => $tittleDoc,
        ]);
        return new Response(302, [], $html);
    }
}
