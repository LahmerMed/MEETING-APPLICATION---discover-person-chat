<?php
require __DIR__ . '/../vendor/autoload.php';

use App\ChatServer;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

$port = 8080;

echo "Démarrage du serveur WebSocket sur le port $port...\n";
echo "Serveur prêt !\n";

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new ChatServer()
        )
    ),
    $port
);

$server->run();
