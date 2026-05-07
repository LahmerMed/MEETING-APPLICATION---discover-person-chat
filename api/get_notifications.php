<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

require_login();

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT n.*, u.name as sender_name 
    FROM notifications n 
    LEFT JOIN users u ON n.related_id = u.id 
    WHERE n.user_id = ? 
    ORDER BY n.created_at DESC 
    LIMIT 20
");
$stmt->execute([$user_id]);
$notifications = $stmt->fetchAll();

$unread_count = get_unread_notifications_count($pdo, $user_id);

json_response([
    'success' => true,
    'notifications' => $notifications,
    'unread_count' => $unread_count
]);
