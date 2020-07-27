<?php

namespace App\Educar\Infrastructure\Repository;

use App\Educar\Model\Aluno;
use App\Educar\Model\Repository\UserRepository;
use App\Educar\Model\Usuario;
use PDO;

class PdoRepoUsers implements UserRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findUser($id): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM usuarios WHERE id = :id;');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function saveUser(Usuario $usuario): bool
    {
        if ($usuario->getId() === null) {
            return $this->insertUser($usuario);
        }

        return $this->updateUser($usuario);
    }

    private function insertUser(Usuario $usuario): bool
    {
        $insertQuery =
            'INSERT INTO usuarios (email, senha)VALUES (:email, :senha);';
        $stmt = $this->connection->prepare($insertQuery);

        $success = $stmt->execute(
            [
                ':email' => $usuario->getEmail(),
                ':senha' => $usuario->getSenha(),
            ]
        );
        if ($success) {
            $usuario->defineIdUser($this->connection->lastInsertId());
        }

        return $success;
    }

    private function updateUser(Usuario $usuario): bool
    {
        $updateQuery =
            'UPDATE usuarios SET email = :email, senha = :senha WHERE id = :id;';
        $stmt = $this->connection->prepare($updateQuery);
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->bindValue(':senha', $usuario->getSenha());
        $stmt->bindValue(':id', $usuario->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function removeUser(Usuario $usuario): bool
    {
        $stmt = $this->connection->prepare(
            'DELETE FROM alunos WHERE id = :id;'
        );
        $stmt->bindValue(':id', $usuario->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }
}
