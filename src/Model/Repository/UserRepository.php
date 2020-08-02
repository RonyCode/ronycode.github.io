<?php

namespace App\Educar\Model\Repository;

use App\Educar\Model\Usuario;

interface UserRepository
{
    public function login(Usuario $usuario): string;

    public function saveUser(Usuario $user): bool;

    public function removeUser(Usuario $user): bool;
}
