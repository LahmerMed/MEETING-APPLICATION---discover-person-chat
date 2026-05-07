<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function require_login() {
    if (!is_logged_in()) {
        header('Location: ' . BASE_URL . '/public/login.php');
        exit;
    }
}

function require_admin() {
    require_login();
    if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
        header('Location: ' . BASE_URL . '/public/dashboard.php');
        exit;
    }
}
