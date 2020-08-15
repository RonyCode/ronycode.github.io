<?php


namespace App\Educar\Model\Repository;


use App\Educar\Model\Usuario;

interface EmailRepository
{
    public function recoverPassword(Usuario $usuario): bool;

    public function validateUpdatePassword(Usuario $usuario): bool;

}