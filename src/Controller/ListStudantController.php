<?php

namespace App\Educar\Controller;

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepo;

class ListStudantController implements InterfaceStartProcess
{
    private $repositorioAlunos;

    public function __construct()
    {
        $pdo = ConnectionFactory::createConnection();
        $this->repositorioAlunos = new PdoRepo($pdo);
    }

    public function startProcess(): void
    {
        $alunos = $this->repositorioAlunos->allStudents();
        $tittleDoc = 'Alunos Cadastrados';
        $tittle = 'Alunos Cadastrados';
        require __DIR__ . '/../View/Main/adicionar.htlm.php';
    }
}