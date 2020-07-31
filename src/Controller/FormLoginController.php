<?php

namespace App\Educar\Controller;

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoUsers;

class FormLoginController extends HtmlRenderController implements InterfaceStartProcess
{


    public function startProcess(): void
    {
        echo $this->renderHtml(
            'login/formulario.php',
            [
                'tittleDoc' => $tittleDoc = 'Login | Usuário',
                'tittle' => $tittle = 'Iniciar Login'
            ]
        );
    }
}
