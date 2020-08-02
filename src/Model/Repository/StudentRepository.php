<?php

namespace App\Educar\Model\Repository;

use App\Educar\Model\Aluno;

interface StudentRepository
{
    public function allStudents(): array;

    public function save(Aluno $aluno): bool;

    public function remove(Aluno $aluno): bool;

    public function find(Aluno $aluno): ALuno;
}
