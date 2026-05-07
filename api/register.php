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

$data = [
    'name' => sanitize_input($_POST['name'] ?? ''),
    'email' => sanitize_input($_POST['email'] ?? ''),
    'password' => $_POST['password'] ?? '',
    'age' => (int)($_POST['age'] ?? 0),
    'city' => sanitize_input($_POST['city'] ?? ''),
    'gender' => sanitize_input($_POST['gender'] ?? ''),
    'interests' => $_POST['interests'] ?? []
];

if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
    json_response(['success' => false, 'message' => 'Veuillez remplir tous les champs obligatoires']);
}

if (!validate_email($data['email'])) {
    json_response(['success' => false, 'message' => 'Email invalide']);
}

if (!validate_password($data['password'])) {
    json_response(['success' => false, 'message' => 'Le mot de passe doit contenir au moins 6 caractères']);
}

if ($_POST['password'] !== $_POST['confirm_password']) {
    json_response(['success' => false, 'message' => 'Les mots de passe ne correspondent pas']);
}

$result = register_user($pdo, $data);

if ($result['success']) {
    json_response(['success' => true, 'message' => 'Inscription réussie !']);
} else {
    json_response(['success' => false, 'message' => $result['message']]);
}
