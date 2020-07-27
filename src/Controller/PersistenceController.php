<?php

namespace App\Educar\Controller;

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoStudents;
use App\Educar\Model\Aluno;

class PersistenceController implements InterfaceStartProcess
{
    private PdoRepoStudents $repoAlunos;

    public function __construct()
    {
        $pdo = ConnectionFactory::createConnection();
        $this->repoAlunos = new PdoRepoStudents($pdo);
    }

    public function startProcess(): void
    {
        $idGet = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $namePost = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $addressPost = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);

        if (!is_null($idGet) && $idGet !== false) {
            $alunoId = $this->repoAlunos->find($idGet);
            $aluno = new Aluno($alunoId['id'], $namePost, $addressPost);
            $this->repoAlunos->save($aluno);
        } else {
            $aluno = new Aluno(null, $namePost, $addressPost);
            $this->repoAlunos->save($aluno);
        }

        header('Location: /listar-alunos', false, 302);
    }
}
