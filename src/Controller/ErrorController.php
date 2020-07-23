<?php


namespace App\Educar\Controller;


class ErrorController implements InterfaceStartProcess
{

    public function startProcess(): void
    {
        require __DIR__ . '/../View/Main/error.html.php';
    }
}