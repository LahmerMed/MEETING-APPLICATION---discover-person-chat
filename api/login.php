<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/constants.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['success' => false, 'message' => 'Méthode non autorisée'], 405);
}

$email = sanitize_input($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    json_response(['success' => false, 'message' => 'Veuillez remplir tous les champs']);
}

$result = login_user($pdo, $email, $password);

if ($result['success']) {
    json_response([
        'success' => true, 
        'message' => 'Connexion réussie !',
        'redirect' => '/projet php/public/dashboard.php'
    ]);
} else {
    json_response(['success' => false, 'message' => $result['message']]);
}
