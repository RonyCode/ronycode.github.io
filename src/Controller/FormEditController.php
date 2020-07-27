<?php

namespace App\Educar\Controller;

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoStudents;
use App\Educar\Model\Aluno;

class FormEditController extends HtmlRenderController implements InterfaceStartProcess
{
    private PdoRepoStudents $repoAlunos;

    public function __construct()
    {
        $pdo = ConnectionFactory::createConnection();
        $this->repoAlunos = new PdoRepoStudents($pdo);
    }

    public function startProcess(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (is_null($id) || $id === false) {
            header('Location: /listar-alunos', true, 302);

            return;
        }

        $alunos = $this->repoAlunos->find($id);

        $id = $alunos['id'];
        $name = $alunos['name'];
        $address = $alunos['address'];

        $aluno = new Aluno($id, $name, $address);


        echo $this->renderHtml(
            'alunos/formulario-aluno.php',
            [
                'tittleDoc' => $tittleDoc = 'Alterar cadastro | Cadastro',
                'tittle' => $tittle = 'Alterar cadastro: ' . $aluno->getName(),
                'aluno' => $aluno,

            ]

        );
    }
}
