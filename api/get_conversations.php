<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

require_login();

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT 
        u.id as user_id,
        u.name,
        u.avatar,
        u.city,
        m.content as last_message,
        m.created_at as last_message_time,
        m.is_read,
        CASE WHEN m.sender_id = ? THEN 1 ELSE 0 END as is_sent
    FROM users u
    JOIN (
        SELECT 
            CASE WHEN sender_id = ? THEN receiver_id ELSE sender_id END as other_user_id,
            MAX(created_at) as max_time
        FROM messages
        WHERE sender_id = ? OR receiver_id = ?
        GROUP BY other_user_id
    ) last_conv ON u.id = last_conv.other_user_id
    JOIN messages m ON (
        (m.sender_id = ? AND m.receiver_id = u.id) OR 
        (m.sender_id = u.id AND m.receiver_id = ?)
    ) AND m.created_at = last_conv.max_time
    WHERE u.id != ?
    ORDER BY m.created_at DESC
");
$stmt->execute([$user_id, $user_id, $user_id, $user_id, $user_id, $user_id, $user_id]);
$conversations = $stmt->fetchAll();

$friends = get_friends($pdo, $user_id);

$conversation_user_ids = array_column($conversations, 'user_id');

foreach ($friends as $friend) {
    if (!in_array($friend['id'], $conversation_user_ids)) {
        $conversations[] = [
            'user_id' => $friend['id'],
            'name' => $friend['name'],
            'avatar' => $friend['avatar'],
            'city' => $friend['city'],
            'last_message' => 'Aucun message pour le moment',
            'last_message_time' => null,
            'is_read' => 1,
            'is_sent' => 0,
            'is_new_friend' => true
        ];
    }
}

json_response(['success' => true, 'conversations' => $conversations]);
