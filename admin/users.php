<?php
session_start();
$page_title = 'Gestion des utilisateurs - SocialApp';
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
                <a href="/admin/users.php" class="flex items-center px-6 py-3 text-purple-400 bg-purple-900/20 border-r-4 border-purple-500">
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
                <h1 class="text-2xl font-bold text-gray-800">Gestion des utilisateurs</h1>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" placeholder="Rechercher un utilisateur" 
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none">
                    </div>
                </div>
            </header>

            <div class="p-8">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Utilisateur</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Email</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Âge</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Ville</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Statut</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=40&h=40&fit=crop&crop=face" 
                                             class="w-10 h-10 rounded-full object-cover">
                                        <span class="ml-3 font-medium text-gray-900">John Doe</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">john@example.com</td>
                                <td class="px-6 py-4 text-gray-600">28</td>
                                <td class="px-6 py-4 text-gray-600">Paris</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">Actif</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-eye"></i></button>
                                    <button class="text-purple-600 hover:text-purple-800 mr-3"><i class="fas fa-edit"></i></button>
                                    <button class="text-red-600 hover:text-red-800"><i class="fas fa-ban"></i></button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=40&h=40&fit=crop&crop=face" 
                                             class="w-10 h-10 rounded-full object-cover">
                                        <span class="ml-3 font-medium text-gray-900">Sarah Martin</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">sarah@example.com</td>
                                <td class="px-6 py-4 text-gray-600">28</td>
                                <td class="px-6 py-4 text-gray-600">Paris</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">Actif</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-eye"></i></button>
                                    <button class="text-purple-600 hover:text-purple-800 mr-3"><i class="fas fa-edit"></i></button>
                                    <button class="text-red-600 hover:text-red-800"><i class="fas fa-ban"></i></button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=40&h=40&fit=crop&crop=face" 
                                             class="w-10 h-10 rounded-full object-cover">
                                        <span class="ml-3 font-medium text-gray-900">Mike Johnson</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">mike@example.com</td>
                                <td class="px-6 py-4 text-gray-600">32</td>
                                <td class="px-6 py-4 text-gray-600">Lyon</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-medium">Désactivé</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-eye"></i></button>
                                    <button class="text-green-600 hover:text-green-800 mr-3"><i class="fas fa-check"></i></button>
                                    <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <p class="text-gray-600">Affichage 1-10 sur 1,247 utilisateurs</p>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 border border-gray-300 rounded-xl hover:bg-gray-50">Précédent</button>
                        <button class="px-4 py-2 gradient-bg text-white rounded-xl">1</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-xl hover:bg-gray-50">2</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-xl hover:bg-gray-50">3</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-xl hover:bg-gray-50">Suivant</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
