<?php


namespace App\Educar\Infrastructure\Repository;


use App\Educar\Helper\Email;
use App\Educar\Model\Repository\EmailRepository;
use App\Educar\Model\Usuario;
use PDO;

class PdoRepoEmail implements EmailRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function recoverPassword(Usuario $usuario): bool
    {
        $stmt = $this->connection->prepare(
            'SELECT * FROM usuarios WHERE email = :email LIMIT 1'
        );
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $stmt->fetch();
            $this->addDadosRecover($usuario);

            return true;
        } else {
            return false;
        }
    }

    private function addDadosRecover(Usuario $usuario): bool
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO recupera_senhas (email, hash) VALUES (:email, :hash);'
        );
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->bindValue(
            ':hash',
            password_hash($usuario->getEmail(), PASSWORD_ARGON2I)
        );
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $this->sendEmail($usuario);
            return true;
        } else {
            return false;
        }
    }

    private function sendEmail(Usuario $usuario): bool
    {
        $email = new Email();
        $bodyEmail = $email->templateEmail($usuario);
        $email
            ->add(
                'Solicitação para troca de sennha',
                $bodyEmail,
                $usuario->getEmail(),
                'Ronycode Dev'
            )
            ->send();
        if ($email === true) {
            return true;
        } else {
            return false;
        }
    }

    public function validateUpdatePassword(Usuario $usuario): bool
    {
        $stmt = $this->connection->prepare(
            'SELECT * FROM recupera_senhas WHERE email = :email'
        );
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            password_verify($usuario->getEmail(), $row['hash']);
            echo $usuario->getEmail();
            return true;
        } else {
            return false;
        }
    }
}