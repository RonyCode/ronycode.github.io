<?php

namespace App\Educar\Controller;

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepo;
use App\Educar\Model\Aluno;

class PersistenceController implements InterfaceStartProcess
{
    private PdoRepo $repositorioAlunos;

    public function __construct()
    {
        $pdo = ConnectionFactory::createConnection();
        $this->repositorioAlunos = new PdoRepo($pdo);
    }

    public function startProcess(): void
    {
        $args = array(
            'name' => FILTER_SANITIZE_STRING,
            'address' => FILTER_SANITIZE_STRING
        );

        $filterInputs = filter_input_array(INPUT_POST, $args);

        $name = $filterInputs['name'];
        $address = $filterInputs['address'];

        $aluno = new Aluno(null, $name, $address);
        $this->repositorioAlunos->save($aluno);
        header('Location: /listar-alunos', true, 302);
    }
}