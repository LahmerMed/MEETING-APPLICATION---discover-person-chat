<?php
session_start();
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

require_login();

$page_title = 'Tableau de bord - SocialApp';
$pending_count = get_pending_invitations_count($pdo, $_SESSION['user_id']);
$pending_invitations = get_pending_invitations($pdo, $_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="../index.php" class="flex items-center">
                        <div class="w-10 h-10 gradient-bg rounded-xl flex items-center justify-center text-white font-bold text-xl">S</div>
                        <span class="ml-3 text-xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">SocialApp</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="discover.php" class="text-gray-600 hover:text-purple-600 px-4 py-2 rounded-lg font-medium transition">
                        <i class="fas fa-search mr-2"></i>Découvrir
                    </a>
                    <a href="invitations.php" class="text-gray-600 hover:text-purple-600 px-4 py-2 rounded-lg font-medium transition relative">
                        <i class="fas fa-user-plus mr-2"></i>Invitations
                        <?php if ($pending_count > 0): ?>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center"><?= $pending_count ?></span>
                        <?php endif; ?>
                    </a>
                    <a href="chat.php" class="text-gray-600 hover:text-purple-600 px-4 py-2 rounded-lg font-medium transition">
                        <i class="fas fa-comments mr-2"></i>Messages
                    </a>
                    <div class="flex items-center ml-4 border-l pl-4">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=40&h=40&fit=crop&crop=face" 
                             class="w-10 h-10 rounded-full object-cover border-2 border-purple-500">
                        <span class="ml-2 font-medium text-gray-700"><?= htmlspecialchars($_SESSION['username']) ?></span>
                    </div>
                    <a href="logout.php" class="text-gray-500 hover:text-red-500 transition">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Bonjour <?= htmlspecialchars($_SESSION['username']) ?> ! 👋</h1>
            <p class="text-gray-600 mt-2">Voici ce qui se passe sur votre compte aujourd'hui.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stat-card bg-white p-6 rounded-2xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Invitations reçues</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1"><?= $pending_count ?></p>
                    </div>
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-inbox text-2xl text-blue-600"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white p-6 rounded-2xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Invitations envoyées</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1"><?= count(get_sent_invitations($pdo, $_SESSION['user_id'])) ?></p>
                    </div>
                    <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-paper-plane text-2xl text-purple-600"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white p-6 rounded-2xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Connexions</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
                    </div>
                    <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-users text-2xl text-green-600"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white p-6 rounded-2xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Messages non lus</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
                    </div>
                    <div class="w-14 h-14 bg-pink-100 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-envelope text-2xl text-pink-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Invitations Received -->
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Invitations récentes</h2>
                    <a href="invitations.php" class="text-purple-600 hover:underline text-sm font-medium">Voir tout</a>
                </div>
                <div class="space-y-4">
                    <?php if (!empty($pending_invitations)): ?>
                        <?php foreach (array_slice($pending_invitations, 0, 2) as $invitation): ?>
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <div class="flex items-center">
                                    <img src="<?= $invitation['avatar'] ?? 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=50&h=50&fit=crop&crop=face' ?>" 
                                         class="w-12 h-12 rounded-full object-cover">
                                    <div class="ml-4">
                                        <p class="font-semibold text-gray-900"><?= htmlspecialchars($invitation['sender_name']) ?></p>
                                        <p class="text-gray-500 text-sm"><?= htmlspecialchars($invitation['city']) ?> • <?= $invitation['age'] ?> ans</p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-gray-500 text-center py-8">Aucune invitation en attente</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Recent Messages -->
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Messages récents</h2>
                    <a href="chat.php" class="text-purple-600 hover:underline text-sm font-medium">Voir tout</a>
                </div>
                <div class="space-y-4">
                    <p class="text-gray-500 text-center py-8">Aucun message pour le moment</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 bg-white p-6 rounded-2xl shadow-lg">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Actions rapides</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="discover.php" class="flex flex-col items-center p-6 bg-purple-50 rounded-xl hover:bg-purple-100 transition">
                    <div class="w-14 h-14 gradient-bg rounded-xl flex items-center justify-center text-white text-2xl mb-3">
                        <i class="fas fa-search"></i>
                    </div>
                    <span class="font-medium text-gray-700">Découvrir</span>
                </a>
                <a href="profile.php" class="flex flex-col items-center p-6 bg-blue-50 rounded-xl hover:bg-blue-100 transition">
                    <div class="w-14 h-14 bg-blue-500 rounded-xl flex items-center justify-center text-white text-2xl mb-3">
                        <i class="fas fa-user-cog"></i>
                    </div>
                    <span class="font-medium text-gray-700">Mon profil</span>
                </a>
                <a href="invitations.php" class="flex flex-col items-center p-6 bg-green-50 rounded-xl hover:bg-green-100 transition">
                    <div class="w-14 h-14 bg-green-500 rounded-xl flex items-center justify-center text-white text-2xl mb-3">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <span class="font-medium text-gray-700">Invitations</span>
                </a>
                <a href="chat.php" class="flex flex-col items-center p-6 bg-pink-50 rounded-xl hover:bg-pink-100 transition">
                    <div class="w-14 h-14 bg-pink-500 rounded-xl flex items-center justify-center text-white text-2xl mb-3">
                        <i class="fas fa-comments"></i>
                    </div>
                    <span class="font-medium text-gray-700">Messages</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
