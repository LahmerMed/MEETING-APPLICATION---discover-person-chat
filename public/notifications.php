<?php
session_start();
$page_title = 'Notifications - SocialApp';
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
<?php
require_once __DIR__ . '/../includes/session.php';
require_login();
?>
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
                    <a href="invitations.php" class="text-gray-600 hover:text-purple-600 transition"><i class="fas fa-user-plus"></i></a>
                    <a href="chat.php" class="text-gray-600 hover:text-purple-600 transition"><i class="fas fa-comments"></i></a>
                    <a href="logout.php" class="text-gray-500 hover:text-red-500 transition"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Notifications</h1>
            <button class="text-purple-600 hover:text-purple-800 font-medium">Tout marquer comme lu</button>
        </div>

        <div class="space-y-4">
            <div class="bg-purple-50 border-l-4 border-purple-500 p-6 rounded-xl">
                <div class="flex items-start gap-4">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=50&h=50&fit=crop&crop=face" 
                         class="w-12 h-12 rounded-full object-cover">
                    <div class="flex-1">
                        <p class="text-gray-800"><span class="font-semibold">Sarah Martin</span> vous a envoyé une invitation</p>
                        <p class="text-gray-500 text-sm mt-1">Il y a 5 minutes</p>
                        <div class="mt-4 flex gap-3">
                            <button class="px-4 py-2 bg-green-500 text-white rounded-lg font-medium hover:bg-green-600 transition">
                                <i class="fas fa-check mr-1"></i>Accepter
                            </button>
                            <button class="px-4 py-2 bg-red-100 text-red-600 rounded-lg font-medium hover:bg-red-200 transition">
                                <i class="fas fa-times mr-1"></i>Refuser
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-start gap-4">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=50&h=50&fit=crop&crop=face" 
                         class="w-12 h-12 rounded-full object-cover">
                    <div class="flex-1">
                        <p class="text-gray-800"><span class="font-semibold">Emma Wilson</span> a accepté votre invitation</p>
                        <p class="text-gray-500 text-sm mt-1">Il y a 1 heure</p>
                        <a href="/public/chat.php" class="inline-block mt-3 px-4 py-2 gradient-bg text-white rounded-lg font-medium hover:shadow-lg transition">
                            <i class="fas fa-comment mr-1"></i>Envoyer un message
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-start gap-4">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=50&h=50&fit=crop&crop=face" 
                         class="w-12 h-12 rounded-full object-cover">
                    <div class="flex-1">
                        <p class="text-gray-800"><span class="font-semibold">Emma Wilson</span> vous a envoyé un message</p>
                        <p class="text-gray-500 text-sm mt-1">Il y a 2 heures</p>
                        <a href="/public/chat.php" class="inline-block mt-3 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition">
                            <i class="fas fa-eye mr-1"></i>Voir le message
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm opacity-75">
                <div class="flex items-start gap-4">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=50&h=50&fit=crop&crop=face" 
                         class="w-12 h-12 rounded-full object-cover">
                    <div class="flex-1">
                        <p class="text-gray-600"><span class="font-semibold">Alex Brown</span> a refusé votre invitation</p>
                        <p class="text-gray-400 text-sm mt-1">Hier</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
