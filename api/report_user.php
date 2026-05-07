<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['success' => false, 'message' => 'Méthode non autorisée'], 405);
}

$reporter_id = $_SESSION['user_id'];
$reported_id = (int)($_POST['reported_id'] ?? 0);
$reason = sanitize_input($_POST['reason'] ?? '');
$type = sanitize_input($_POST['type'] ?? 'user');

if (!$reported_id || empty($reason)) {
    json_response(['success' => false, 'message' => 'Veuillez remplir tous les champs']);
}

$stmt = $pdo->prepare("
    INSERT INTO reports (reporter_id, reported_id, reason, type, status, created_at)
    VALUES (?, ?, ?, ?, 0, NOW())
");
$stmt->execute([$reporter_id, $reported_id, $reason, $type]);

json_response(['success' => true, 'message' => 'Signalement envoyé !']);
