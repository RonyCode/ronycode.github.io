<?php

namespace App\Educar\Controller;

class FormInsertController extends HtmlRenderController implements InterfaceStartProcess
{
    public function startProcess(): void
    {
        $tittleDoc = 'Espaço Educar | Cadastro';
        $tittle = 'Adicionar aluno';
        echo $this->renderHtml(
            'alunos/formulario-aluno.php',
            [
                'tittle' => $tittle,
                'tittleDoc' => $tittleDoc
            ]
        );
    }
}
