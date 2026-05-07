<?php
session_start();
$page_title = 'Mon profil - SocialApp';
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

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="gradient-bg h-40"></div>
            <div class="px-8 pb-8 -mt-16">
                <div class="flex items-end justify-between">
                    <div class="flex items-end">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=160&h=160&fit=crop&crop=face" 
                                 class="w-32 h-32 rounded-full border-4 border-white shadow-lg object-cover">
                            <button class="absolute bottom-0 right-0 w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center text-white hover:bg-purple-700 transition">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                        <div class="ml-6 mb-2">
                            <h1 class="text-3xl font-bold text-gray-900">John Doe</h1>
                            <p class="text-gray-500">Paris, France • 28 ans</p>
                        </div>
                    </div>
                    <div class="flex gap-3 mb-2">
                        <button class="px-4 py-2 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition">
                            <i class="fas fa-eye mr-2"></i>Aperçu
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white p-6 rounded-2xl shadow-lg">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Informations personnelles</h2>
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                                <input type="text" value="John Doe" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" value="john@example.com" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Âge</label>
                                <input type="number" value="28" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Ville</label>
                                <input type="text" value="Paris" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                            <textarea rows="4" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="Parlez-nous de vous...">Passionné de photographie, de voyages et de cuisine. J'aime découvrir de nouvelles cultures et rencontrer des gens intéressants !</textarea>
                        </div>
                        <button type="submit" class="gradient-bg text-white px-8 py-3 rounded-xl font-medium hover:shadow-lg transition">
                            Enregistrer les modifications
                        </button>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-lg">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Centres d'intérêt</h2>
                    <div class="flex flex-wrap gap-3">
                        <span class="px-4 py-2 bg-purple-100 text-purple-700 rounded-full flex items-center gap-2">
                            <i class="fas fa-camera"></i>Photographie
                            <button class="hover:text-purple-900"><i class="fas fa-times"></i></button>
                        </span>
                        <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full flex items-center gap-2">
                            <i class="fas fa-plane"></i>Voyages
                            <button class="hover:text-blue-900"><i class="fas fa-times"></i></button>
                        </span>
                        <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full flex items-center gap-2">
                            <i class="fas fa-utensils"></i>Cuisine
                            <button class="hover:text-green-900"><i class="fas fa-times"></i></button>
                        </span>
                        <span class="px-4 py-2 bg-pink-100 text-pink-700 rounded-full flex items-center gap-2">
                            <i class="fas fa-music"></i>Musique
                            <button class="hover:text-pink-900"><i class="fas fa-times"></i></button>
                        </span>
                        <button class="px-4 py-2 border-2 border-dashed border-gray-300 rounded-full text-gray-500 hover:border-purple-500 hover:text-purple-500 transition">
                            <i class="fas fa-plus mr-2"></i>Ajouter
                        </button>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-lg">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Changer le mot de passe</h2>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe actuel</label>
                            <input type="password" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nouveau mot de passe</label>
                            <input type="password" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Confirmer le nouveau mot de passe</label>
                            <input type="password" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                        <button type="submit" class="gradient-bg text-white px-8 py-3 rounded-xl font-medium hover:shadow-lg transition">
                            Mettre à jour le mot de passe
                        </button>
                    </form>
                </div>
            </div>

            <div class="space-y-8">
                <div class="bg-white p-6 rounded-2xl shadow-lg">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Visibilité</h2>
                    <div class="space-y-4">
                        <label class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                            <div>
                                <p class="font-medium text-gray-900">Profil public</p>
                                <p class="text-sm text-gray-500">Tout le monde peut voir votre profil</p>
                            </div>
                            <div class="relative">
                                <input type="checkbox" id="public" class="sr-only peer" checked>
                                <div class="w-14 h-8 bg-gray-300 peer-checked:bg-purple-600 rounded-full transition"></div>
                                <div class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full shadow transition peer-checked:translate-x-6"></div>
                            </div>
                        </label>
                        <label class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                            <div>
                                <p class="font-medium text-gray-900">Afficher l'âge</p>
                                <p class="text-sm text-gray-500">Montrer votre âge sur votre profil</p>
                            </div>
                            <div class="relative">
                                <input type="checkbox" id="show_age" class="sr-only peer" checked>
                                <div class="w-14 h-8 bg-gray-300 peer-checked:bg-purple-600 rounded-full transition"></div>
                                <div class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full shadow transition peer-checked:translate-x-6"></div>
                            </div>
                        </label>
                        <label class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                            <div>
                                <p class="font-medium text-gray-900">Afficher la ville</p>
                                <p class="text-sm text-gray-500">Montrer votre ville sur votre profil</p>
                            </div>
                            <div class="relative">
                                <input type="checkbox" id="show_city" class="sr-only peer" checked>
                                <div class="w-14 h-8 bg-gray-300 peer-checked:bg-purple-600 rounded-full transition"></div>
                                <div class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full shadow transition peer-checked:translate-x-6"></div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-lg border-2 border-red-100">
                    <h2 class="text-xl font-bold text-red-600 mb-6">Zone dangereuse</h2>
                    <div class="space-y-4">
                        <button class="w-full px-4 py-3 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition font-medium">
                            <i class="fas fa-user-slash mr-2"></i>Désactiver mon compte
                        </button>
                        <button class="w-full px-4 py-3 bg-red-100 text-red-700 rounded-xl hover:bg-red-200 transition font-medium">
                            <i class="fas fa-trash mr-2"></i>Supprimer mon compte
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
