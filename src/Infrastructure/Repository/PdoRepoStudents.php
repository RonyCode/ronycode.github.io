<?php

namespace App\Educar\Infrastructure\Repository;

use App\Educar\Model\Aluno;
use App\Educar\Model\Repository\StudentRepository;
use PDO;

class PdoRepoStudents implements StudentRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function allStudents(): array
    {
        $sqlQuery = "SELECT * FROM alunos;";
        $stmt = $this->connection->query($sqlQuery);

        return $this->hydrateStudentList($stmt);
    }

    public function hydrateStudentList(\PDOStatement $stmt): array
    {
        $studentDataList = $stmt->fetchAll();
        $studentList = [];
        foreach ($studentDataList as $studentData) {
            $studentList[] = new Aluno($studentData['id'], $studentData['name'],
                $studentData['address']);
        }

        return $studentList;
    }

    public function save(Aluno $aluno): bool
    {
        if ($aluno->getId() === null) {
            return $this->insert($aluno);
        }

        return $this->update($aluno);
    }

    private function insert(Aluno $aluno): bool
    {
        $insertQuery = 'INSERT INTO alunos (name, address)VALUES (:name, :address);';
        $stmt = $this->connection->prepare($insertQuery);

        $success = $stmt->execute([
            ':name' => $aluno->getName(),
            ':address' => $aluno->getAddress(),
        ]);
        if ($success) {
            $aluno->defineId($this->connection->lastInsertId());
        }

        return $success;
    }

    private function update(Aluno $aluno): bool
    {
        $updateQuery = 'UPDATE alunos SET name = :name, address = :address WHERE id = :id;';
        $stmt = $this->connection->prepare($updateQuery);
        $stmt->bindValue(':name', $aluno->getName());
        $stmt->bindValue(':address', $aluno->getAddress());
        $stmt->bindValue(':id', $aluno->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function remove(Aluno $aluno): bool
    {
        $stmt = $this->connection->prepare('DELETE FROM alunos WHERE id = :id;');
        $stmt->bindValue(':id', $aluno->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function find(Aluno $aluno): Aluno
    {
        $stmt = $this->connection->prepare('SELECT * FROM alunos WHERE id = :id;');
        $stmt->bindValue(':id', $aluno->getId(), PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch();
            $aluno = new Aluno($result['id'], $result['name'],
                $result['address']);
        }
        return $aluno;
    }
}
