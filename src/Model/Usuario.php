<?php

namespace App\Educar\Model;

class Usuario
{
    private ?int $id;
    private string $usuario;
    private string $email;
    private string $senha;

    public function __construct(
        ?int $id,
        string $usuario,
        string $email,
        string $senha
    ) {
        $this->id = $id;
        $this->usuario = $usuario;
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

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    public function senhaEstaCorreta(string $senhaHash): bool
    {
        return password_verify($this->senha, $senhaHash);
    }

    public function defineIdUser(int $id): void
    {
        if (!is_null($this->id)) {
            throw new \DomainException('Você sõ pode definir o ID uma vez');
        }

        $this->id = $id;
    }

    public function getUsuario(): string
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }
}
