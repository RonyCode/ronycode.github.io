<?php

namespace App\Educar\Controller;

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepo;

class HomeController implements InterfaceStartProcess
{
    private $repositorioAlunos;

    public function __construct()
    {
        $pdo = ConnectionFactory::createConnection();
        $this->repositorioAlunos = new PdoRepo($pdo);
    }

    public function startProcess(): void
    {
        $tittleDoc = 'Espaço Educar | Home';
        $tittle = 'Escola Espaço Educar ensinando com amor';
        require __DIR__ . '/../View/Main/home.html.php';
    }
}