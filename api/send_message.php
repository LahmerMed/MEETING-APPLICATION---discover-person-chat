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
$content = sanitize_input($_POST['content'] ?? '');

if (!$receiver_id || empty($content)) {
    json_response(['success' => false, 'message' => 'Veuillez remplir tous les champs']);
}

$stmt = $pdo->prepare("
    INSERT INTO messages (sender_id, receiver_id, content, created_at)
    VALUES (?, ?, ?, NOW())
");
$stmt->execute([$sender_id, $receiver_id, $content]);

create_notification($pdo, $receiver_id, 'message', $_SESSION['username'] . ' vous a envoyé un message', $sender_id);

json_response(['success' => true, 'message' => 'Message envoyé !', 'message_id' => $pdo->lastInsertId()]);
