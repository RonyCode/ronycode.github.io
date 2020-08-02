<?php

namespace App\Educar\Controller;

use App\Educar\Helper\FlashMessageTrait;
use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoStudents;
use App\Educar\Model\Aluno;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RemoveController implements RequestHandlerInterface
{
    use FlashMessageTrait;
    private PdoRepoStudents $repoAlunos;

    public function __construct()
    {
        $pdo = ConnectionFactory::createConnection();
        $this->repoAlunos = new PdoRepoStudents($pdo);
    }

    public function handle($request): ResponseInterface
    {
        $id = filter_var($request->getQueryParams()['id'], FILTER_VALIDATE_INT);

        $response = new Response(302, ['Location' => '/listar-alunos']);

        if (is_null($id) || $id === false) {
            $this->definyMessage('danger', 'Aluno não cadastrado');
            return $response;
        }

        $alunos = new Aluno($id, '', '');

        $this->repoAlunos->remove($alunos);
        $this->definyMessage('danger', 'Aluno removido com sucesso');

        return $response;
    }
}
