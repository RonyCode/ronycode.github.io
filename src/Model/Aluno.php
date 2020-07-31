<?php

namespace App\Educar\Model;

class Aluno
{
    private ?int $id;
    private string $name;
    private string $address;

    public function __construct(?int $id, string $name, string $address)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function defineId(int $id): void
    {
        if (!is_null($this->id)) {
            throw new \DomainException('Você sõ pode definir o ID uma vez');
        }

        $this->id = $id;
    }
}
