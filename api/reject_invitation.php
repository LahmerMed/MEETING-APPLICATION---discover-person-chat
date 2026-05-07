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

if (reject_invitation($pdo, $invitation_id, $receiver_id)) {
    json_response(['success' => true, 'message' => 'Invitation refusée !']);
} else {
    json_response(['success' => false, 'message' => 'Erreur lors du refus de l\'invitation']);
}
