<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['success' => false, 'message' => 'Méthode non autorisée'], 405);
}

$blocker_id = $_SESSION['user_id'];
$blocked_id = (int)($_POST['blocked_id'] ?? 0);

if (!$blocked_id) {
    json_response(['success' => false, 'message' => 'ID utilisateur manquant']);
}

try {
    $stmt = $pdo->prepare("
        INSERT INTO blocks (blocker_id, blocked_id, created_at)
        VALUES (?, ?, NOW())
    ");
    $stmt->execute([$blocker_id, $blocked_id]);
    
    json_response(['success' => true, 'message' => 'Utilisateur bloqué !']);
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        json_response(['success' => false, 'message' => 'Utilisateur déjà bloqué']);
    }
    json_response(['success' => false, 'message' => 'Erreur lors du blocage']);
}
