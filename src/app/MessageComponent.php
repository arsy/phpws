<?php

namespace Arsy\App;


use Arsy\App\Helper\SplObjectStorageHelper;
use Arsy\App\Model\Message;
use Arsy\App\Model\User;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use SplObjectStorage;

class MessageComponent implements MessageComponentInterface
{

    private $users;
    private $connections;
    private $log;

    public function __construct()
    {
        $this->users       = new SplObjectStorage();
        $this->connections = new SplObjectStorage();
        // create a log channel
        $this->log = new Logger('ws-logger');
        $this->log->pushHandler(new StreamHandler(__DIR__ . '/../../log/ws.log'));
    }

    /**
     * When a new connection is opened it will be passed to this method
     * @param  ConnectionInterface $conn The socket/connection that just connected to your application
     * @throws \Exception
     */
    function onOpen(ConnectionInterface $conn)
    {
        $user = new User();
        $user->setId($conn->resourceId)
             ->setName("Guest" . $conn->resourceId);

        $this->users->attach($user);
        $this->connections->attach($conn);

//        $stdUser             = new \stdClass();
//        $stdUser->type       = "ack";
//        $stdUser->data       = new \stdClass();
//        $stdUser->data->id   = $user->getId();
//        $stdUser->data->name = $user->getName();
//
//        $conn->send(json_encode($stdUser));
        $this->log->info("New connection", (array)$user);
    }

    /**
     * This is called before or after a socket is closed (depends on how it's closed).  SendMessage to $conn will not result in an error if it has already been closed.
     * @param  ConnectionInterface $conn The socket/connection that is closing/closed
     * @throws \Exception
     */
    function onClose(ConnectionInterface $conn)
    {
        if ($user = SplObjectStorageHelper::containsUser($this->users, $conn)) {
            $this->users->detach($user);
        }
        if ($this->connections->contains($conn)) {
            $this->connections->detach($conn);
        }

        $conn->close();
        $this->log->info("Connection closed", (array)$conn);
    }

    /**
     * If there is an error with one of the sockets, or somewhere in the application where an Exception is thrown,
     * the Exception is sent back down the stack, handled by the Server and bubbled back up the application through this method
     * @param  ConnectionInterface $conn
     * @param  \Exception $e
     * @throws \Exception
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        $this->log->error($e->getMessage() . " in " . $e->getFile() . " in " . $e->getLine(), $conn);

        // Todo: Send info to client about error
    }

    /**
     * Triggered when a client sends data through the socket
     * @param  \Ratchet\ConnectionInterface $from The socket/connection that sent the message to your application
     * @param  string $msg The message received
     * @throws \Exception
     */
    function onMessage(ConnectionInterface $from, $msg)
    {
        $incomingMsg = json_decode($msg);
        var_dump($msg);
//        $message = new Message();
        /** @var User $fromUser */
        $fromUser = SplObjectStorageHelper::containsUser($this->users, $from);
        $toUser   =


            var_dump($msg);
    }
}