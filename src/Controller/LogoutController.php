<?php


namespace App\Educar\Controller;


class LogoutController implements InterfaceStartProcess
{

    public function startProcess(): void
    {
        session_unset();
        session_destroy();
        header('Location: /formulario-login', false, 302);
    }
}