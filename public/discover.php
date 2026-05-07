<?php
session_start();
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

require_login();

$page_title = 'Découvrir - SocialApp';
$users = get_available_users($pdo, $_SESSION['user_id']);
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
        .user-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="dashboard.php" class="flex items-center">
                        <div class="w-10 h-10 gradient-bg rounded-xl flex items-center justify-center text-white font-bold text-xl">S</div>
                        <span class="ml-3 text-xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">SocialApp</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="dashboard.php" class="text-gray-600 hover:text-purple-600 transition"><i class="fas fa-home"></i></a>
                    <a href="invitations.php" class="text-gray-600 hover:text-purple-600 transition"><i class="fas fa-user-plus"></i></a>
                    <a href="chat.php" class="text-gray-600 hover:text-purple-600 transition"><i class="fas fa-comments"></i></a>
                    <a href="logout.php" class="text-gray-500 hover:text-red-500 transition"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <div class="lg:w-80 flex-shrink-0">
                <div class="bg-white p-6 rounded-2xl shadow-lg sticky top-24">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Filtres</h2>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Âge</label>
                            <div class="flex gap-4">
                                <input type="number" placeholder="Min" min="18" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-xl">
                                <input type="number" placeholder="Max" min="18" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-xl">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Ville</label>
                            <input type="text" placeholder="Rechercher une ville" class="w-full px-4 py-2 border border-gray-300 rounded-xl">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Sexe</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" class="w-4 h-4 text-purple-600 mr-3">
                                    <span class="text-gray-700">Homme</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="w-4 h-4 text-purple-600 mr-3" checked>
                                    <span class="text-gray-700">Femme</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="w-4 h-4 text-purple-600 mr-3">
                                    <span class="text-gray-700">Autre</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Centres d'intérêt</label>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm cursor-pointer">Sport</span>
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm cursor-pointer">Musique</span>
                                <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm cursor-pointer">Voyage</span>
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm cursor-pointer">Cuisine</span>
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm cursor-pointer">Art</span>
                            </div>
                        </div>
                        <button class="w-full gradient-bg text-white py-3 rounded-xl font-medium hover:shadow-lg transition">
                            Appliquer les filtres
                        </button>
                        <button class="w-full px-4 py-3 border border-gray-300 rounded-xl text-gray-600 hover:bg-gray-50 transition">
                            Réinitialiser
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex-1">
                <div class="mb-6 flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-900">Découvrir des personnes</h1>
                    <p class="text-gray-500"><?= count($users) ?> résultats</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6" id="users-grid">
                    <?php foreach ($users as $user): ?>
                        <div class="user-card bg-white rounded-2xl shadow-lg overflow-hidden transition duration-300" data-user-id="<?= $user['id'] ?>">
                            <div class="relative">
                                <img src="<?= $user['avatar'] ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=300&fit=crop' ?>" class="w-full h-64 object-cover">
                            </div>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="text-xl font-bold text-gray-900"><?= htmlspecialchars($user['name']) ?>, <?= $user['age'] ?></h3>
                                    <span class="flex items-center text-gray-500 text-sm">
                                        <i class="fas fa-map-marker-alt mr-1"></i><?= htmlspecialchars($user['city']) ?>
                                    </span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2"><?= htmlspecialchars($user['bio'] ?? 'Aucune bio') ?></p>
                                
                                <?php if ($user['relation_status'] === 'available'): ?>
                                    <button class="w-full invite-btn gradient-bg text-white py-3 rounded-xl font-medium hover:shadow-lg transition flex items-center justify-center gap-2" data-receiver-id="<?= $user['id'] ?>">
                                        <i class="fas fa-paper-plane"></i>Envoyer une invitation
                                    </button>
                                <?php elseif ($user['relation_status'] === 'pending_sent'): ?>
                                    <button class="w-full bg-gray-200 text-gray-500 py-3 rounded-xl font-medium cursor-not-allowed">
                                        <i class="fas fa-clock mr-2"></i>Invitation envoyée
                                    </button>
                                <?php elseif ($user['relation_status'] === 'pending_received'): ?>
                                    <a href="invitations.php" class="w-full bg-yellow-100 text-yellow-700 py-3 rounded-xl font-medium text-center block">
                                        <i class="fas fa-bell mr-2"></i>Répondre à l'invitation
                                    </a>
                                <?php elseif ($user['relation_status'] === 'friends'): ?>
                                    <a href="chat.php" class="w-full bg-green-100 text-green-700 py-3 rounded-xl font-medium text-center block">
                                        <i class="fas fa-check mr-2"></i>Déjà amis - Envoyer un message
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if (empty($users)): ?>
                    <div class="text-center py-12">
                        <div class="text-gray-400 text-6xl mb-4">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-700 mb-2">Aucun utilisateur trouvé</h3>
                        <p class="text-gray-500">Il n'y a pas d'autres utilisateurs pour le moment.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.invite-btn').forEach(btn => {
                btn.addEventListener('click', async function() {
                    const receiverId = this.dataset.receiverId;
                    const originalText = this.innerHTML;
                    
                    this.disabled = true;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi en cours...';
                    
                    try {
                        const formData = new FormData();
                        formData.append('receiver_id', receiverId);
                        
                        const response = await fetch('../api/send_invitation.php', {
                            method: 'POST',
                            body: formData
                        });
                        
                        const result = await response.json();
                        
                        if (result.success) {
                            alert(result.message);
                            this.innerHTML = '<i class="fas fa-clock mr-2"></i> Invitation envoyée';
                            this.className = 'w-full bg-gray-200 text-gray-500 py-3 rounded-xl font-medium cursor-not-allowed';
                            this.removeEventListener('click', arguments.callee);
                        } else {
                            alert(result.message);
                            this.disabled = false;
                            this.innerHTML = originalText;
                        }
                    } catch (error) {
                        alert('Erreur lors de l\'envoi de l\'invitation.');
                        this.disabled = false;
                        this.innerHTML = originalText;
                    }
                });
            });
        });
    </script>
</body>
</html>
