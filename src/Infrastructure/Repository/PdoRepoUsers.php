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

    public function login(Usuario $usuario): bool
    {
        $stmt = $this->connection->prepare('SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1');
        $stmt->bindValue(':usuario', $usuario->getUsuario());
        $stmt->execute();

        if ($stmt->rowCount() < 0) {
            echo 'erro usuario não existe';
            exit();
        } else {
            $usuarioQuery = $stmt->fetch();
            $senhaDB = $usuarioQuery['senha'];
            $validate = password_verify($senha, $senhaDB);
        }
        return $validate;
    }

    public function saveUser(Usuario $usuario): bool
    {
        if ($usuario->getID() === null) {
            return $this->insertUser($usuario);
        }
        return $this->updateUser($usuario);
    }

    private function insertUser(Usuario $usuario): bool
    {
        $insertQuery = 'INSERT INTO usuarios (usuario, email, senha) VALUES (:usuario, :email, :senha);';
        $stmt = $this->connection->prepare($insertQuery);
        try {
            $stmt->execute([
                ':usuario' => $usuario->getUsuario(),
                ':email' => $usuario->getEmail(),
                ':senha' => \password_hash($usuario->getSenha(),
                    \PASSWORD_ARGON2I),
            ]);

            $usuario->defineIdUser($this->connection->lastInsertId());

            // VALIDA SE USUÁRIO JÁ TEM CADASTRO E IMPEDE NOVO CADASTRO//
        } catch (\PDOException $e) {
            if ($e->getCode() == '23000') {
                echo 'Usuário ou senha já cadastrado : ';
                exit();
            }
        } finally {
            return true;
        }
    }

    private function updateUser(Usuario $usuario): bool
    {
        $updateQuery = 'UPDATE usuarios SET usuario=:usuario,  email = :email, senha = :senha WHERE id = :id;';
        $stmt = $this->connection->prepare($updateQuery);
        $stmt->bindValue(':usuario', $usuario->getUsuario());
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->bindValue(':senha', $usuario->getSenha());
        $stmt->bindValue(':id', $usuario->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function removeUser(Usuario $usuario): bool
    {
        $stmt = $this->connection->prepare('DELETE FROM usuarios WHERE id = :id;');
        $stmt->bindValue(':id', $usuario->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }
}
