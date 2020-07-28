<?php

namespace App\Educar\Infrastructure\Repository;

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

    public function login($email, $senha): bool
    {

        $stmt = $this->connection->prepare('SELECT id FROM usuarios WHERE email = :email AND   senha = :senha');
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $userLogin = $stmt->fetch();
            $_SESSION['senhaUser'] = $userLogin['senha'];
            return true;

        } else {
            return false;
        }
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
        $stmt = $this->connection->prepare('SELECT id FROM usuarios WHERE email = :email;');
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return false;
        }

        $insertQuery = 'INSERT INTO usuarios (email, senha)VALUES (:email, :senha);';
        $stmt = $this->connection->prepare($insertQuery);

        $success = $stmt->execute([
            ':email' => $usuario->getEmail(),
            ':senha' => $usuario->getSenha(),
        ]);
        if ($success) {
            $usuario->defineIdUser($this->connection->lastInsertId());
        }

        return $success;
    }

    private function updateUser(Usuario $usuario): bool
    {
        $updateQuery = 'UPDATE usuarios SET email = :email, senha = :senha WHERE id = :id;';
        $stmt = $this->connection->prepare($updateQuery);
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->bindValue(':senha', $usuario->getSenha());
        $stmt->bindValue(':id', $usuario->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function removeUser(Usuario $usuario): bool
    {
        $stmt = $this->connection->prepare('DELETE FROM alunos WHERE id = :id;');
        $stmt->bindValue(':id', $usuario->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }


}
