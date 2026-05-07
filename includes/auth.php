<?php
function register_user($pdo, $data) {
    $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
    
    $interests = isset($data['interests']) ? json_encode($data['interests']) : '[]';
    
    $stmt = $pdo->prepare("
        INSERT INTO users (name, email, password, age, city, gender, interests, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
    ");
    
    try {
        $stmt->execute([
            $data['name'],
            $data['email'],
            $hashed_password,
            $data['age'],
            $data['city'],
            $data['gender'],
            $interests
        ]);
        return ['success' => true, 'user_id' => $pdo->lastInsertId()];
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            return ['success' => false, 'message' => 'Cet email est déjà utilisé'];
        }
        return ['success' => false, 'message' => 'Erreur lors de l\'inscription'];
    }
}

function login_user($pdo, $email, $password) {
    $user = get_user_by_email($pdo, $email);
    
    if (!$user) {
        return ['success' => false, 'message' => 'Email ou mot de passe incorrect'];
    }
    
    if ($user['status'] != USER_STATUS_ACTIVE) {
        return ['success' => false, 'message' => 'Ce compte a été désactivé'];
    }
    
    if (!password_verify($password, $user['password'])) {
        return ['success' => false, 'message' => 'Email ou mot de passe incorrect'];
    }
    
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['avatar'] = $user['avatar'] ?? '/assets/uploads/default.jpg';
    $_SESSION['is_admin'] = (bool)$user['is_admin'];
    
    return ['success' => true, 'user' => $user];
}

function logout_user() {
    session_unset();
    session_destroy();
}
