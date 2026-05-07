<?php
session_start();
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

require_login();

$page_title = 'Invitations - SocialApp';
$pending_invitations = get_pending_invitations($pdo, $_SESSION['user_id']);
$sent_invitations = get_sent_invitations($pdo, $_SESSION['user_id']);
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
                    <a href="discover.php" class="text-gray-600 hover:text-purple-600 transition"><i class="fas fa-search"></i></a>
                    <a href="chat.php" class="text-gray-600 hover:text-purple-600 transition"><i class="fas fa-comments"></i></a>
                    <a href="logout.php" class="text-gray-500 hover:text-red-500 transition"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Invitations</h1>

        <div class="flex border-b border-gray-200 mb-8" id="tabs">
            <button class="tab-btn px-6 py-3 font-medium text-purple-600 border-b-2 border-purple-600" data-tab="received">
                Reçues <span class="ml-2 bg-purple-100 text-purple-600 px-2 py-0.5 rounded-full text-sm"><?= count($pending_invitations) ?></span>
            </button>
            <button class="tab-btn px-6 py-3 font-medium text-gray-500 hover:text-gray-700" data-tab="sent">
                Envoyées <span class="ml-2 bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full text-sm"><?= count($sent_invitations) ?></span>
            </button>
        </div>

        <!-- Invitations received -->
        <div id="received-tab" class="tab-content space-y-4">
            <?php if (!empty($pending_invitations)): ?>
                <?php foreach ($pending_invitations as $invitation): ?>
                    <div class="invitation-card bg-white p-6 rounded-2xl shadow-lg flex items-center justify-between" data-invitation-id="<?= $invitation['id'] ?>">
                        <div class="flex items-center">
                            <img src="<?= $invitation['avatar'] ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=80&h=80&fit=crop&crop=face' ?>" 
                                 class="w-16 h-16 rounded-full object-cover">
                            <div class="ml-4">
                                <h3 class="font-bold text-gray-900 text-lg"><?= htmlspecialchars($invitation['sender_name']) ?></h3>
                                <p class="text-gray-500"><?= htmlspecialchars($invitation['city']) ?> • <?= $invitation['age'] ?> ans</p>
                                <p class="text-gray-400 text-sm">Invitation reçue le <?= date('d/m/Y à H:i', strtotime($invitation['created_at'])) ?></p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <button class="accept-btn px-6 py-3 bg-green-500 text-white rounded-xl font-medium hover:bg-green-600 transition flex items-center gap-2" data-invitation-id="<?= $invitation['id'] ?>">
                                <i class="fas fa-check"></i>Accepter
                            </button>
                            <button class="reject-btn px-6 py-3 bg-red-100 text-red-600 rounded-xl font-medium hover:bg-red-200 transition flex items-center gap-2" data-invitation-id="<?= $invitation['id'] ?>">
                                <i class="fas fa-times"></i>Refuser
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-12 bg-white rounded-2xl shadow-lg">
                    <div class="text-gray-400 text-6xl mb-4">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Aucune invitation en attente</h3>
                    <p class="text-gray-500 mb-6">Vous n'avez pas reçu d'invitations pour le moment.</p>
                    <a href="discover.php" class="inline-block gradient-bg text-white px-6 py-3 rounded-xl font-medium hover:shadow-lg transition">
                        <i class="fas fa-search mr-2"></i>Découvrir des personnes
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Invitations sent -->
        <div id="sent-tab" class="tab-content space-y-4 hidden">
            <?php if (!empty($sent_invitations)): ?>
                <?php foreach ($sent_invitations as $invitation): ?>
                    <div class="bg-white p-6 rounded-2xl shadow-lg flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="<?= $invitation['avatar'] ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=80&h=80&fit=crop&crop=face' ?>" 
                                 class="w-16 h-16 rounded-full object-cover">
                            <div class="ml-4">
                                <h3 class="font-bold text-gray-900 text-lg"><?= htmlspecialchars($invitation['receiver_name']) ?></h3>
                                <p class="text-gray-500"><?= htmlspecialchars($invitation['city']) ?> • <?= $invitation['age'] ?> ans</p>
                                <p class="text-gray-400 text-sm">
                                    Invitation envoyée le <?= date('d/m/Y à H:i', strtotime($invitation['created_at'])) ?> - 
                                    <?php if ($invitation['status'] == 0): ?>
                                        <span class="text-yellow-600 font-medium">En attente</span>
                                    <?php elseif ($invitation['status'] == 1): ?>
                                        <span class="text-green-600 font-medium">Acceptée</span>
                                    <?php elseif ($invitation['status'] == 2): ?>
                                        <span class="text-red-600 font-medium">Refusée</span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        <?php if ($invitation['status'] == 1): ?>
                            <a href="chat.php" class="gradient-bg text-white px-6 py-3 rounded-xl font-medium hover:shadow-lg transition">
                                <i class="fas fa-comments mr-2"></i>Envoyer un message
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-12 bg-white rounded-2xl shadow-lg">
                    <div class="text-gray-400 text-6xl mb-4">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Aucune invitation envoyée</h3>
                    <p class="text-gray-500 mb-6">Vous n'avez pas envoyé d'invitations pour le moment.</p>
                    <a href="discover.php" class="inline-block gradient-bg text-white px-6 py-3 rounded-xl font-medium hover:shadow-lg transition">
                        <i class="fas fa-search mr-2"></i>Découvrir des personnes
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Tabs management
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active classes from all buttons
                document.querySelectorAll('.tab-btn').forEach(b => {
                    b.classList.remove('text-purple-600', 'border-b-2', 'border-purple-600');
                    b.classList.add('text-gray-500');
                });
                
                // Hide all tab contents
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                });
                
                // Add active class to clicked button
                this.classList.add('text-purple-600', 'border-b-2', 'border-purple-600');
                this.classList.remove('text-gray-500');
                
                // Show corresponding tab content
                const tabId = this.dataset.tab + '-tab';
                document.getElementById(tabId).classList.remove('hidden');
            });
        });

        // Accept invitation
        document.querySelectorAll('.accept-btn').forEach(btn => {
            btn.addEventListener('click', async function() {
                const invitationId = this.dataset.invitationId;
                const originalText = this.innerHTML;
                
                this.disabled = true;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Traitement...';
                
                try {
                    const formData = new FormData();
                    formData.append('invitation_id', invitationId);
                    
                    const response = await fetch('../api/accept_invitation.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        alert(result.message);
                        // Remove the invitation card
                        const card = this.closest('.invitation-card');
                        card.style.opacity = '0';
                        card.style.transform = 'translateX(100px)';
                        setTimeout(() => card.remove(), 300);
                    } else {
                        alert(result.message);
                        this.disabled = false;
                        this.innerHTML = originalText;
                    }
                } catch (error) {
                    alert('Erreur lors de l\'acceptation de l\'invitation.');
                    this.disabled = false;
                    this.innerHTML = originalText;
                }
            });
        });

        // Reject invitation
        document.querySelectorAll('.reject-btn').forEach(btn => {
            btn.addEventListener('click', async function() {
                const invitationId = this.dataset.invitationId;
                const originalText = this.innerHTML;
                
                this.disabled = true;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Traitement...';
                
                try {
                    const formData = new FormData();
                    formData.append('invitation_id', invitationId);
                    
                    const response = await fetch('../api/reject_invitation.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        alert(result.message);
                        // Remove the invitation card
                        const card = this.closest('.invitation-card');
                        card.style.opacity = '0';
                        card.style.transform = 'translateX(100px)';
                        setTimeout(() => card.remove(), 300);
                    } else {
                        alert(result.message);
                        this.disabled = false;
                        this.innerHTML = originalText;
                    }
                } catch (error) {
                    alert('Erreur lors du refus de l\'invitation.');
                    this.disabled = false;
                    this.innerHTML = originalText;
                }
            });
        });
    </script>
</body>
</html>
