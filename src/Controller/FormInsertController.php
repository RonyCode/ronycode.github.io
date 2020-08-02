<?php

namespace App\Educar\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormInsertController extends HtmlRenderController implements RequestHandlerInterface
{
    public function handle($request): ResponseInterface
    {
        $tittleDoc = 'Espaço Educar | Cadastro';
        $tittle = 'Adicionar aluno';
        $html = $this->renderHtml('alunos/formulario-aluno.php', [
            'tittle' => $tittle,
            'tittleDoc' => $tittleDoc
        ]);
        return new Response(202, [], $html);
    }
}
