<?php

namespace App\Educar\Controller;

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoStudents;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListAlunosController extends HtmlRenderController implements
    RequestHandlerInterface
{
    private $repositorioAlunos;

    public function __construct()
    {
        $pdo = ConnectionFactory::createConnection();
        $this->repositorioAlunos = new PdoRepoStudents($pdo);
    }

    public function handle($request): ResponseInterface
    {
        $alunos = $this->repositorioAlunos->allStudents();
        $tittleDoc = 'Alunos Cadastrados';

        $tittle = 'Bem Vindo: ' . $_SESSION['logado'];

        $html = $this->renderHtml('alunos/listar-alunos.php', [
            'alunos' => $alunos,
            'tittleDoc' => $tittleDoc,
            'tittle' => $tittle,
        ]);
        return new Response(200, [], $html);
    }
}
