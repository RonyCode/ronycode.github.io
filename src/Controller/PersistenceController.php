<?php

namespace App\Educar\Controller;

use App\Educar\Helper\FlashMessageTrait;
use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoStudents;
use App\Educar\Model\Aluno;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PersistenceController implements RequestHandlerInterface
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
        $idGet = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );
        $namePost = filter_var(
            $request->getParsedBody()['name'],
            FILTER_SANITIZE_STRING
        );
        $addressPost = filter_var(
            $request->getParsedBody()['address'],
            FILTER_SANITIZE_STRING
        );

        if (!is_null($idGet) && $idGet !== false) {
            $aluno = new Aluno($idGet, $namePost, $addressPost);
            $this->repoAlunos->save($aluno);
            $this->definyMessage('success', 'Aluno atualizado com sucesso');
        } else {
            $aluno = new Aluno(null, $namePost, $addressPost);
            $this->repoAlunos->save($aluno);
            $this->definyMessage('success', 'Aluno inserido com sucesso');
        }

        return new Response(302, ['Location' => '/listar-alunos']);
    }
}
