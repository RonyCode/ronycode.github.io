<?php


namespace App\Educar\Helper;


trait FlashMessageTrait
{
    public function definyMessage(string $tipo, string $mensagem): void
    {
        $_SESSION['mensagem'] = $mensagem;
        $_SESSION['tipo_mensagem'] = $tipo;
    }
}