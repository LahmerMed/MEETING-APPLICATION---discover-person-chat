<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['success' => false, 'message' => 'Méthode non autorisée'], 405);
}

$sender_id = $_SESSION['user_id'];
$receiver_id = (int)($_POST['receiver_id'] ?? 0);

if (!$receiver_id) {
    json_response(['success' => false, 'message' => 'ID utilisateur manquant']);
}

if ($sender_id === $receiver_id) {
    json_response(['success' => false, 'message' => 'Vous ne pouvez pas vous inviter vous-même']);
}

try {
    $stmt = $pdo->prepare("
        INSERT INTO invitations (sender_id, receiver_id, status, created_at)
        VALUES (?, ?, 0, NOW())
    ");
    $stmt->execute([$sender_id, $receiver_id]);
    
    create_notification($pdo, $receiver_id, 'invitation', $_SESSION['username'] . ' vous a envoyé une invitation', $sender_id);
    
    json_response(['success' => true, 'message' => 'Invitation envoyée !']);
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        json_response(['success' => false, 'message' => 'Invitation déjà envoyée']);
    }
    json_response(['success' => false, 'message' => 'Erreur lors de l\'envoi de l\'invitation']);
}
