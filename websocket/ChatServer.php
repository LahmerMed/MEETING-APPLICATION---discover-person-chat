<?php
namespace App;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use PDO;

class ChatServer implements MessageComponentInterface
{
    protected $clients;
    protected $pdo;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
        
        $host = 'localhost';
        $dbname = 'socialapp';
        $username = 'root';
        $password = '';
        
        try {
            $this->pdo = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            die("Erreur de connexion DB: " . $e->getMessage());
        }
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "Nouvelle connexion ! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);
        
        if (!isset($data['type'])) {
            return;
        }

        switch ($data['type']) {
            case 'register':
                $from->userId = $data['user_id'];
                echo "Utilisateur {$data['user_id']} connecté\n";
                break;

            case 'message':
                $this->handleMessage($from, $data);
                break;
        }
    }

    protected function handleMessage(ConnectionInterface $from, $data)
    {
        $senderId = $data['sender_id'];
        $receiverId = $data['receiver_id'];
        $content = $data['content'];

        $stmt = $this->pdo->prepare("
            INSERT INTO messages (sender_id, receiver_id, content, created_at)
            VALUES (?, ?, ?, NOW())
        ");
        $stmt->execute([$senderId, $receiverId, $content]);
        $messageId = $this->pdo->lastInsertId();

        $stmt = $this->pdo->prepare("SELECT name, avatar FROM users WHERE id = ?");
        $stmt->execute([$senderId]);
        $sender = $stmt->fetch();

        $message = [
            'type' => 'message',
            'id' => $messageId,
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'content' => $content,
            'sender_name' => $sender['name'],
            'sender_avatar' => $sender['avatar'],
            'created_at' => date('Y-m-d H:i:s')
        ];

        foreach ($this->clients as $client) {
            if (isset($client->userId) && 
                ($client->userId == $senderId || $client->userId == $receiverId)) {
                $client->send(json_encode($message));
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connexion {$conn->resourceId} fermée\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Erreur: {$e->getMessage()}\n";
        $conn->close();
    }
}
