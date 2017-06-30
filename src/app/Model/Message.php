<?php

namespace Arsy\App\Model;


use Arsy\App\Contract\MessageInterface;

class Message implements MessageInterface
{

    private $fromId = 0;
    private $toId = 0;
    private $message = "";


    function setChannel(): MessageInterface
    {
        // TODO: Implement setChannel() method.
    }

    function getChannel(): string
    {
        // TODO: Implement getChannel() method.
    }

    function setFromId(int $fromId): MessageInterface
    {
        $this->fromId = $fromId;

        return $this;
    }

    function getFromId(): int
    {
        return $this->fromId;
    }

    function setToId(int $toId): MessageInterface
    {
        $this->toId = $toId;

        return $this;
    }

    function getToId(): int
    {
        return $this->toId;
    }

    function setMessage(string $message): MessageInterface
    {
        $this->setMessage($message);

        return $this;
    }

    function getMessage(): string
    {
        return $this->message;
    }

    function __toString(): string
    {
        return json_encode([
            'fromId'  => $this->getFromId(),
            'toId'    => $this->getToId(),
            'message' => $this->getMessage()
        ]);
    }
}