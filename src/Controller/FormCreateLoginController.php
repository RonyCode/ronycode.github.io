<?php


namespace App\Educar\Controller;


class FormCreateLoginController extends HtmlRenderController implements InterfaceStartProcess
{
    public function startProcess(): void
    {
        $tittle = 'Cadastrar usuário';
        $tittleDoc = 'Cadastro | Login';

        echo $this->renderHtml('/login/formulario-cadastrar-login.php', [
            'tittle' => $tittle = 'Cadastrar usuário',
            'tittleDoc' => $tittleDoc = 'Cadastro | Login'
        ]);
    }
}