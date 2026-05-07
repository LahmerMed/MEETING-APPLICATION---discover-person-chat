<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

require_login();

$user_id = $_SESSION['user_id'];
$other_user_id = (int)($_GET['user_id'] ?? 0);

if (!$other_user_id) {
    json_response(['success' => false, 'message' => 'ID utilisateur manquant']);
}

$other_user = get_user_by_id($pdo, $other_user_id);
if (!$other_user) {
    json_response(['success' => false, 'message' => 'Utilisateur non trouvé']);
}

$stmt = $pdo->prepare("
    SELECT m.*, u.name as sender_name, u.avatar as sender_avatar
    FROM messages m
    JOIN users u ON m.sender_id = u.id
    WHERE (m.sender_id = ? AND m.receiver_id = ?) OR (m.sender_id = ? AND m.receiver_id = ?)
    ORDER BY m.created_at ASC
");
$stmt->execute([$user_id, $other_user_id, $other_user_id, $user_id]);
$messages = $stmt->fetchAll();

$update_stmt = $pdo->prepare("
    UPDATE messages 
    SET is_read = 1 
    WHERE sender_id = ? AND receiver_id = ? AND is_read = 0
");
$update_stmt->execute([$other_user_id, $user_id]);

json_response([
    'success' => true,
    'other_user' => $other_user,
    'messages' => $messages
]);
