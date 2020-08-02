<?php

namespace App\Educar\Controller;

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoStudents;
use App\Educar\Model\Aluno;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormEditController extends HtmlRenderController implements RequestHandlerInterface
{
    private PdoRepoStudents $repoAlunos;

    public function __construct()
    {
        $pdo = ConnectionFactory::createConnection();
        $this->repoAlunos = new PdoRepoStudents($pdo);
    }

    public function handle($request): ResponseInterface
    {
        $id = filter_var($request->getQueryParams()['id'], FILTER_VALIDATE_INT);

        if ($id === false || is_null($id)) {
            return new Response(302, ['Location' => '/listar-alunos']);
        }
        $alunoPost = new Aluno($id, '', ''

        );

        $aluno = $this->repoAlunos->find($alunoPost);


        $html = $this->renderHtml('alunos/formulario-aluno.php', [
                'tittleDoc' => $tittleDoc = 'Alterar cadastro | Cadastro',
                'tittle' => $tittle = 'Alterar cadastro: ' . $aluno->getName(),
                'aluno' => $aluno,

            ]

        );
        return new Response(202, [], $html);
    }
}
