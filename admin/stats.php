<?php
session_start();
$page_title = 'Statistiques - SocialApp';
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
                <a href="/admin/reports.php" class="flex items-center px-6 py-3 text-gray-400 hover:text-white hover:bg-gray-800 transition">
                    <i class="fas fa-flag w-6"></i>
                    <span class="ml-3">Signalements</span>
                </a>
                <a href="/admin/stats.php" class="flex items-center px-6 py-3 text-purple-400 bg-purple-900/20 border-r-4 border-purple-500">
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
            <header class="bg-white shadow-sm px-8 py-4">
                <h1 class="text-2xl font-bold text-gray-800">Statistiques détaillées</h1>
            </header>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Nouveaux utilisateurs (ce mois)</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">142</p>
                            </div>
                            <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-user-plus text-2xl text-blue-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Messages échangés</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">5,847</p>
                            </div>
                            <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-comments text-2xl text-purple-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Invitations envoyées</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">4,320</p>
                            </div>
                            <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-paper-plane text-2xl text-green-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Taux de réponse</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">78%</p>
                            </div>
                            <div class="w-14 h-14 bg-yellow-100 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-percentage text-2xl text-yellow-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Activité mensuelle</h2>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <span class="w-24 text-gray-600">Jan</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-4 mx-4">
                                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-4 rounded-full" style="width: 45%"></div>
                                </div>
                                <span class="text-gray-600 font-medium">450</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-24 text-gray-600">Fév</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-4 mx-4">
                                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-4 rounded-full" style="width: 55%"></div>
                                </div>
                                <span class="text-gray-600 font-medium">550</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-24 text-gray-600">Mar</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-4 mx-4">
                                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-4 rounded-full" style="width: 65%"></div>
                                </div>
                                <span class="text-gray-600 font-medium">650</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-24 text-gray-600">Avr</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-4 mx-4">
                                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-4 rounded-full" style="width: 80%"></div>
                                </div>
                                <span class="text-gray-600 font-medium">800</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-24 text-gray-600">Mai</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-4 mx-4">
                                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-4 rounded-full" style="width: 95%"></div>
                                </div>
                                <span class="text-gray-600 font-medium">950</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Villes les plus actives</h2>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-city text-blue-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <p class="font-semibold text-gray-900">Paris</p>
                                        <p class="text-gray-500 text-sm">452 utilisateurs</p>
                                    </div>
                                </div>
                                <span class="text-2xl font-bold text-gray-700">36%</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-city text-purple-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <p class="font-semibold text-gray-900">Lyon</p>
                                        <p class="text-gray-500 text-sm">187 utilisateurs</p>
                                    </div>
                                </div>
                                <span class="text-2xl font-bold text-gray-700">15%</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-city text-green-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <p class="font-semibold text-gray-900">Marseille</p>
                                        <p class="text-gray-500 text-sm">142 utilisateurs</p>
                                    </div>
                                </div>
                                <span class="text-2xl font-bold text-gray-700">11%</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-city text-yellow-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <p class="font-semibold text-gray-900">Autres villes</p>
                                        <p class="text-gray-500 text-sm">466 utilisateurs</p>
                                    </div>
                                </div>
                                <span class="text-2xl font-bold text-gray-700">38%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
