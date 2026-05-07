<?php
session_start();
$page_title = 'Administration - SocialApp';
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
                <a href="/admin/index.php" class="flex items-center px-6 py-3 text-purple-400 bg-purple-900/20 border-r-4 border-purple-500">
                    <i class="fas fa-tachometer-alt w-6"></i>
                    <span class="ml-3">Tableau de bord</span>
                </a>
                <a href="/admin/users.php" class="flex items-center px-6 py-3 text-gray-400 hover:text-white hover:bg-gray-800 transition">
                    <i class="fas fa-users w-6"></i>
                    <span class="ml-3">Utilisateurs</span>
                </a>
                <a href="/admin/reports.php" class="flex items-center px-6 py-3 text-gray-400 hover:text-white hover:bg-gray-800 transition">
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
                <h1 class="text-2xl font-bold text-gray-800">Tableau de bord</h1>
                <div class="flex items-center gap-4">
                    <span class="text-gray-600">Admin</span>
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=40&h=40&fit=crop&crop=face" 
                         class="w-10 h-10 rounded-full">
                </div>
            </header>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Total utilisateurs</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">1,247</p>
                            </div>
                            <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-users text-2xl text-blue-600"></i>
                            </div>
                        </div>
                        <p class="text-green-500 text-sm mt-4">
                            <i class="fas fa-arrow-up mr-1"></i>+12% ce mois
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Invitations acceptées</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">3,428</p>
                            </div>
                            <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-user-check text-2xl text-green-600"></i>
                            </div>
                        </div>
                        <p class="text-green-500 text-sm mt-4">
                            <i class="fas fa-arrow-up mr-1"></i>+8% ce mois
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Invitations refusées</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">892</p>
                            </div>
                            <div class="w-14 h-14 bg-red-100 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-user-times text-2xl text-red-600"></i>
                            </div>
                        </div>
                        <p class="text-gray-500 text-sm mt-4">Stable</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Signalements</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">24</p>
                            </div>
                            <div class="w-14 h-14 bg-yellow-100 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-flag text-2xl text-yellow-600"></i>
                            </div>
                        </div>
                        <p class="text-red-500 text-sm mt-4">
                            <i class="fas fa-arrow-up mr-1"></i>+5 cette semaine
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Répartition par sexe</h2>
                        <div class="space-y-4">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-gray-700">Hommes</span>
                                    <span class="font-bold text-gray-900">624 (50%)</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-blue-500 h-3 rounded-full" style="width: 50%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-gray-700">Femmes</span>
                                    <span class="font-bold text-gray-900">586 (47%)</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-pink-500 h-3 rounded-full" style="width: 47%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-gray-700">Autres</span>
                                    <span class="font-bold text-gray-900">37 (3%)</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-purple-500 h-3 rounded-full" style="width: 3%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Activité récente</h2>
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user-plus text-green-600"></i>
                                </div>
                                <div class="ml-4 flex-1">
                                    <p class="text-gray-800"><span class="font-semibold">Nouvel utilisateur</span> inscrit</p>
                                    <p class="text-gray-500 text-sm">Il y a 5 minutes</p>
                                </div>
                            </div>
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-heart text-purple-600"></i>
                                </div>
                                <div class="ml-4 flex-1">
                                    <p class="text-gray-800"><span class="font-semibold">Invitation acceptée</span></p>
                                    <p class="text-gray-500 text-sm">Il y a 12 minutes</p>
                                </div>
                            </div>
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-flag text-yellow-600"></i>
                                </div>
                                <div class="ml-4 flex-1">
                                    <p class="text-gray-800"><span class="font-semibold">Nouveau signalement</span> reçu</p>
                                    <p class="text-gray-500 text-sm">Il y a 25 minutes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
