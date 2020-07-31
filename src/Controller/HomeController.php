<?php

namespace App\Educar\Controller;

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoStudents;

class HomeController extends HtmlRenderController implements InterfaceStartProcess
{
    private $repositorioAlunos;

    public function __construct()
    {
        $pdo = ConnectionFactory::createConnection();
        $this->repositorioAlunos = new PdoRepoStudents($pdo);
    }

    public function startProcess(): void
    {
        echo $this->renderHtml(
            'alunos/home.php',
            [
                'tittleDoc' => $tittleDoc = 'Espaço Educar | Home',
                'tittle' => $tittle = 'Escola Espaço Educar ensinando com amor'
            ]
        );
    }
}
