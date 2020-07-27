<?php

namespace App\Educar\Model;

class Usuario
{
    private ?int $id;
    private string $email;
    private string $senha;

    public function __construct(?int $id, string $email, string $senha)
    {
        $this->id = $id;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function getSenha(): string
    {
        return $this->senha;
    }

    public function senhaEstaCorreta(string $senhaPura): bool
    {
        return password_verify($senhaPura, $this->senha);
    }

    public function defineIdUser(int $id): void
    {
        if (!is_null($this->id)) {
            throw new \DomainException('Você sõ pode definir o ID uma vez');
        }

        $this->id = $id;
    }
}
