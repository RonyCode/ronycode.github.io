<?php

namespace App\Educar\Controller;

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoStudents;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomeController extends HtmlRenderController implements RequestHandlerInterface
{
    private $repositorioAlunos;

    public function __construct()
    {
        $pdo = ConnectionFactory::createConnection();
        $this->repositorioAlunos = new PdoRepoStudents($pdo);
    }

    public function handle($request): ResponseInterface
    {
        $html = $this->renderHtml('alunos/home.php', [
            'tittleDoc' => $tittleDoc = 'Espaço Educar | Home',
            'tittle' => $tittle = 'Escola Espaço Educar ensinando com amor'
        ]);
        return new Response(200, [], $html);
    }
}
