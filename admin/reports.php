<?php
session_start();
$page_title = 'Signalements - SocialApp';
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
<body class="bg-gray-100 min-h-screen">
    <div class="flex">
        <aside class="w-64 bg-gray-900 min-h-screen fixed">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="w-10 h-10 gradient-bg rounded-xl flex items-center justify-center text-white font-bold text-xl">S</div>
                    <span class="ml-3 text-xl font-bold text-white">Admin</span>
                </div>
            </div>
            <nav class="mt-6">
                <a href="/admin/index.php" class="flex items-center px-6 py-3 text-gray-400 hover:text-white hover:bg-gray-800 transition">
                    <i class="fas fa-tachometer-alt w-6"></i>
                    <span class="ml-3">Tableau de bord</span>
                </a>
                <a href="/admin/users.php" class="flex items-center px-6 py-3 text-gray-400 hover:text-white hover:bg-gray-800 transition">
                    <i class="fas fa-users w-6"></i>
                    <span class="ml-3">Utilisateurs</span>
                </a>
                <a href="/admin/reports.php" class="flex items-center px-6 py-3 text-purple-400 bg-purple-900/20 border-r-4 border-purple-500">
                    <i class="fas fa-flag w-6"></i>
                    <span class="ml-3">Signalements</span>
                </a>
                <a href="/admin/stats.php" class="flex items-center px-6 py-3 text-gray-400 hover:text-white hover:bg-gray-800 transition">
                    <i class="fas fa-chart-bar w-6"></i>
                    <span class="ml-3">Statistiques</span>
                </a>
            </nav>
            <div class="absolute bottom-0 w-64 p-6 border-t border-gray-800">
                <a href="/public/dashboard.php" class="flex items-center text-gray-400 hover:text-white transition">
                    <i class="fas fa-arrow-left w-6"></i>
                    <span class="ml-3">Retour au site</span>
                </a>
            </div>
        </aside>

        <main class="ml-64 flex-1">
            <header class="bg-white shadow-sm px-8 py-4 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800">Gestion des signalements</h1>
                <div class="flex gap-3">
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl font-medium">Tous</button>
                    <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-xl font-medium">En attente</button>
                    <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-xl font-medium">Traités</button>
                </div>
            </header>

            <div class="p-8">
                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-flag text-red-600 text-xl"></i>
                                </div>
                                <div>
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="font-bold text-gray-900 text-lg">Signalement contre Mike Johnson</h3>
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-medium">En attente</span>
                                    </div>
                                    <p class="text-gray-600 mb-3">Signalé par Sarah Martin • Il y a 2 heures</p>
                                    <div class="bg-gray-50 p-4 rounded-xl">
                                        <p class="text-gray-700">"Cet utilisateur a envoyé des messages inappropriés et harcelants."</p>
                                    </div>
                                </div>
                            </div>
                            <span class="text-gray-500 text-sm">ID: #1247</span>
                        </div>
                        <div class="mt-6 flex gap-3">
                            <button class="px-6 py-3 bg-red-500 text-white rounded-xl font-medium hover:bg-red-600 transition">
                                <i class="fas fa-ban mr-2"></i>Désactiver le compte
                            </button>
                            <button class="px-6 py-3 bg-green-500 text-white rounded-xl font-medium hover:bg-green-600 transition">
                                <i class="fas fa-check mr-2"></i>Marquer comme traité
                            </button>
                            <button class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition">
                                <i class="fas fa-eye mr-2"></i>Voir le profil
                            </button>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-flag text-red-600 text-xl"></i>
                                </div>
                                <div>
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="font-bold text-gray-900 text-lg">Signalement contre Alex Brown</h3>
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-medium">En attente</span>
                                    </div>
                                    <p class="text-gray-600 mb-3">Signalé par Tom Davis • Il y a 5 heures</p>
                                    <div class="bg-gray-50 p-4 rounded-xl">
                                        <p class="text-gray-700">"Profil avec photos inappropriées et contenu non conforme aux règles."</p>
                                    </div>
                                </div>
                            </div>
                            <span class="text-gray-500 text-sm">ID: #1246</span>
                        </div>
                        <div class="mt-6 flex gap-3">
                            <button class="px-6 py-3 bg-red-500 text-white rounded-xl font-medium hover:bg-red-600 transition">
                                <i class="fas fa-ban mr-2"></i>Désactiver le compte
                            </button>
                            <button class="px-6 py-3 bg-green-500 text-white rounded-xl font-medium hover:bg-green-600 transition">
                                <i class="fas fa-check mr-2"></i>Marquer comme traité
                            </button>
                            <button class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition">
                                <i class="fas fa-eye mr-2"></i>Voir le profil
                            </button>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg opacity-75">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check-circle text-gray-500 text-xl"></i>
                                </div>
                                <div>
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="font-bold text-gray-700 text-lg">Signalement contre Lisa Anderson</h3>
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">Traité</span>
                                    </div>
                                    <p class="text-gray-500 mb-3">Signalé par Emma Wilson • Hier</p>
                                    <div class="bg-gray-50 p-4 rounded-xl">
                                        <p class="text-gray-600">"Message considéré comme spam."</p>
                                    </div>
                                </div>
                            </div>
                            <span class="text-gray-400 text-sm">ID: #1245</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
