<?php

use Arsy\App\MessageComponent;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

require __DIR__ . "/../vendor/autoload.php";

$server = IoServer::factory(
    new HttpServer(
        (new WsServer(
            new MessageComponent()
        ))->disableVersion(0)
    ),
    6868
);

$server->run();