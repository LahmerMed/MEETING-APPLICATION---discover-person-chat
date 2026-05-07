<?php
session_start();
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/auth.php';

logout_user();
header('Location: ../index.php');
exit;
?>
