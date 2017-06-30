<?php

namespace Arsy\App\Model;


use Arsy\App\Contract\UserInterface;

class User implements UserInterface
{
    private $name = "";
    private $id = 0;

    function setId(int $id): UserInterface
    {
        $this->id = $id;

        return $this;
    }

    function getId(): int
    {
        return $this->id;
    }

    function setName(string $name): UserInterface
    {
        $this->name = $name;

        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }

    function __toString(): string
    {
        return json_encode([
            'id'   => $this->getId(),
            'name' => $this->getName()
        ]);
    }

}