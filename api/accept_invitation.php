<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['success' => false, 'message' => 'Méthode non autorisée'], 405);
}

$receiver_id = $_SESSION['user_id'];
$invitation_id = (int)($_POST['invitation_id'] ?? 0);

if (!$invitation_id) {
    json_response(['success' => false, 'message' => 'ID invitation manquant']);
}

if (accept_invitation($pdo, $invitation_id, $receiver_id)) {
    json_response(['success' => true, 'message' => 'Invitation acceptée !']);
} else {
    json_response(['success' => false, 'message' => 'Erreur lors de l\'acceptation de l\'invitation']);
}
