<?php

namespace Arsy\App\Contract;


interface UserInterface
{
    function setId(int $id): UserInterface;

    function getId(): int;

    function setName(string $name): UserInterface;

    function getName(): string;

    function __toString(): string;

}