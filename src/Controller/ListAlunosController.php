<?php

namespace App\Educar\Controller;

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoStudents;
use App\Educar\Model\Usuario;

class ListAlunosController extends HtmlRenderController implements
    InterfaceStartProcess
{
    private $repositorioAlunos;

    public function __construct()
    {
        $pdo = ConnectionFactory::createConnection();
        $this->repositorioAlunos = new PdoRepoStudents($pdo);
    }

    public function startProcess(): void
    {
        $alunos = $this->repositorioAlunos->allStudents();
        $tittleDoc = 'Alunos Cadastrados';

        $tittle = 'Bem Vindo: ' . $_SESSION['usuario'];

        echo $this->renderHtml('alunos/listar-alunos.php', [
            'alunos' => $alunos,
            'tittleDoc' => $tittleDoc,
            'tittle' => $tittle,
        ]);
    }
}
