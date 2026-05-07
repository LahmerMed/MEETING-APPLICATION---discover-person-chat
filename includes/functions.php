<?php
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validate_password($password) {
    return strlen($password) >= 6;
}

function redirect($url) {
    header('Location: ' . $url);
    exit;
}

function json_response($data, $status_code = 200) {
    http_response_code($status_code);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

function get_user_by_id($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetch();
}

function get_user_by_email($pdo, $email) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch();
}

function create_notification($pdo, $user_id, $type, $message, $related_id = null) {
    $stmt = $pdo->prepare("INSERT INTO notifications (user_id, type, message, related_id, created_at) VALUES (?, ?, ?, ?, NOW())");
    return $stmt->execute([$user_id, $type, $message, $related_id]);
}

function get_unread_notifications_count($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM notifications WHERE user_id = ? AND is_read = 0");
    $stmt->execute([$user_id]);
    $result = $stmt->fetch();
    return $result['count'];
}

function send_invitation($pdo, $sender_id, $receiver_id) {
    try {
        $stmt = $pdo->prepare("INSERT INTO invitations (sender_id, receiver_id, status) VALUES (?, ?, 0)");
        $result = $stmt->execute([$sender_id, $receiver_id]);
        
        if ($result) {
            $sender = get_user_by_id($pdo, $sender_id);
            create_notification($pdo, $receiver_id, 'invitation', $sender['name'] . ' vous a envoyé une invitation', $pdo->lastInsertId());
        }
        
        return $result;
    } catch (PDOException $e) {
        return false;
    }
}

function accept_invitation($pdo, $invitation_id, $receiver_id) {
    $stmt = $pdo->prepare("UPDATE invitations SET status = 1, updated_at = NOW() WHERE id = ? AND receiver_id = ?");
    $result = $stmt->execute([$invitation_id, $receiver_id]);
    
    if ($result) {
        $invitation = get_invitation_by_id($pdo, $invitation_id);
        $receiver = get_user_by_id($pdo, $receiver_id);
        create_notification($pdo, $invitation['sender_id'], 'accepted', $receiver['name'] . ' a accepté votre invitation', $invitation_id);
    }
    
    return $result;
}

function reject_invitation($pdo, $invitation_id, $receiver_id) {
    $stmt = $pdo->prepare("UPDATE invitations SET status = 2, updated_at = NOW() WHERE id = ? AND receiver_id = ?");
    $result = $stmt->execute([$invitation_id, $receiver_id]);
    
    if ($result) {
        $invitation = get_invitation_by_id($pdo, $invitation_id);
        $receiver = get_user_by_id($pdo, $receiver_id);
        create_notification($pdo, $invitation['sender_id'], 'rejected', $receiver['name'] . ' a refusé votre invitation', $invitation_id);
    }
    
    return $result;
}

function get_invitation_by_id($pdo, $invitation_id) {
    $stmt = $pdo->prepare("SELECT * FROM invitations WHERE id = ?");
    $stmt->execute([$invitation_id]);
    return $stmt->fetch();
}

function get_pending_invitations($pdo, $user_id) {
    $stmt = $pdo->prepare("
        SELECT i.*, u.name as sender_name, u.avatar, u.age, u.city, u.gender 
        FROM invitations i 
        JOIN users u ON i.sender_id = u.id 
        WHERE i.receiver_id = ? AND i.status = 0 
        ORDER BY i.created_at DESC
    ");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}

function get_sent_invitations($pdo, $user_id) {
    $stmt = $pdo->prepare("
        SELECT i.*, u.name as receiver_name, u.avatar, u.age, u.city, u.gender 
        FROM invitations i 
        JOIN users u ON i.receiver_id = u.id 
        WHERE i.sender_id = ? 
        ORDER BY i.created_at DESC
    ");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}

function get_available_users($pdo, $current_user_id) {
    $stmt = $pdo->prepare("
        SELECT u.*, 
            CASE 
                WHEN i1.id IS NOT NULL AND i1.status = 0 THEN 'pending_sent'
                WHEN i2.id IS NOT NULL AND i2.status = 0 THEN 'pending_received'
                WHEN i1.id IS NOT NULL AND i1.status = 1 THEN 'friends'
                WHEN i2.id IS NOT NULL AND i2.status = 1 THEN 'friends'
                ELSE 'available'
            END as relation_status
        FROM users u
        LEFT JOIN invitations i1 ON u.id = i1.receiver_id AND i1.sender_id = ?
        LEFT JOIN invitations i2 ON u.id = i2.sender_id AND i2.receiver_id = ?
        WHERE u.id != ? AND u.status = 1
        ORDER BY u.created_at DESC
    ");
    $stmt->execute([$current_user_id, $current_user_id, $current_user_id]);
    return $stmt->fetchAll();
}

function get_pending_invitations_count($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM invitations WHERE receiver_id = ? AND status = 0");
    $stmt->execute([$user_id]);
    $result = $stmt->fetch();
    return $result['count'];
}

function get_friends($pdo, $user_id) {
    $stmt = $pdo->prepare("
        SELECT u.*
        FROM users u
        JOIN invitations i ON (
            (i.sender_id = u.id AND i.receiver_id = ?) OR 
            (i.receiver_id = u.id AND i.sender_id = ?)
        )
        WHERE u.id != ? AND i.status = 1 AND u.status = 1
        ORDER BY u.name ASC
    ");
    $stmt->execute([$user_id, $user_id, $user_id]);
    return $stmt->fetchAll();
}

function are_friends($pdo, $user1_id, $user2_id) {
    $stmt = $pdo->prepare("
        SELECT id FROM invitations 
        WHERE status = 1 AND (
            (sender_id = ? AND receiver_id = ?) OR 
            (sender_id = ? AND receiver_id = ?)
        )
    ");
    $stmt->execute([$user1_id, $user2_id, $user2_id, $user1_id]);
    return $stmt->fetch() !== false;
}
