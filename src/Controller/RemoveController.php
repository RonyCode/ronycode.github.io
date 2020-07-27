<?php

namespace App\Educar\Controller;

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoStudents;
use App\Educar\Model\Aluno;

class RemoveController implements InterfaceStartProcess
{
    private PdoRepoStudents $repoAlunos;

    public function __construct()
    {
        $pdo = ConnectionFactory::createConnection();
        $this->repoAlunos = new PdoRepoStudents($pdo);
    }

    public function startProcess(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (is_null($id) || $id === false) {
            header('Location: /listar-alunos');
            return;
        }

        $alunos = new Aluno(
            $id, '', ''
        );

        $this->repoAlunos->remove($alunos);
        header('Location: /listar-alunos');
    }
}
