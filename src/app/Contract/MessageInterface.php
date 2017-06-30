<?php

namespace Arsy\App\Contract;


interface MessageInterface
{
    function setChannel(): MessageInterface;

    function getChannel(): string;

    function setFromId(int $fromId): MessageInterface;

    function getFromId(): int;

    function setToId(int $toId): MessageInterface;

    function getToId(): int;

    function setMessage(string $message): MessageInterface;

    function getMessage(): string;

    function __toString(): string;
}