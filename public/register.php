<?php
session_start();
$page_title = 'Inscription - SocialApp';
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
<body class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">
    <div class="max-w-2xl w-full">
        <div class="text-center mb-8">
            <a href="../index.php" class="inline-flex items-center">
                <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center text-white font-bold text-2xl">S</div>
                <span class="ml-3 text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">SocialApp</span>
            </a>
            <h2 class="mt-8 text-3xl font-bold text-gray-900">Créer votre compte</h2>
            <p class="mt-2 text-gray-600">Rejoignez notre communauté et rencontrez des personnes incroyables</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form id="registerForm" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" id="name" name="name" required
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                placeholder="John Doe">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" id="email" name="email" required
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                placeholder="john@example.com">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" id="password" name="password" required
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div>
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" id="confirm_password" name="confirm_password" required
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div>
                        <label for="age" class="block text-sm font-medium text-gray-700 mb-2">Âge</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-birthday-cake"></i>
                            </span>
                            <input type="number" id="age" name="age" min="18" max="120" required
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                placeholder="25">
                        </div>
                    </div>

                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Sexe</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-venus-mars"></i>
                            </span>
                            <select id="gender" name="gender" required
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                                <option value="">Sélectionnez</option>
                                <option value="male">Homme</option>
                                <option value="female">Femme</option>
                                <option value="other">Autre</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Ville</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-city"></i>
                            </span>
                            <input type="text" id="city" name="city" required
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                placeholder="Paris">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Centres d'intérêt (sélectionnez au moins un)</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-xl cursor-pointer hover:bg-purple-50 hover:border-purple-500 transition">
                            <input type="checkbox" name="interests[]" value="sport" class="w-4 h-4 text-purple-600">
                            <span class="text-gray-700"><i class="fas fa-running mr-2"></i>Sport</span>
                        </label>
                        <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-xl cursor-pointer hover:bg-purple-50 hover:border-purple-500 transition">
                            <input type="checkbox" name="interests[]" value="music" class="w-4 h-4 text-purple-600">
                            <span class="text-gray-700"><i class="fas fa-music mr-2"></i>Musique</span>
                        </label>
                        <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-xl cursor-pointer hover:bg-purple-50 hover:border-purple-500 transition">
                            <input type="checkbox" name="interests[]" value="cinema" class="w-4 h-4 text-purple-600">
                            <span class="text-gray-700"><i class="fas fa-film mr-2"></i>Cinéma</span>
                        </label>
                        <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-xl cursor-pointer hover:bg-purple-50 hover:border-purple-500 transition">
                            <input type="checkbox" name="interests[]" value="travel" class="w-4 h-4 text-purple-600">
                            <span class="text-gray-700"><i class="fas fa-plane mr-2"></i>Voyage</span>
                        </label>
                        <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-xl cursor-pointer hover:bg-purple-50 hover:border-purple-500 transition">
                            <input type="checkbox" name="interests[]" value="reading" class="w-4 h-4 text-purple-600">
                            <span class="text-gray-700"><i class="fas fa-book mr-2"></i>Lecture</span>
                        </label>
                        <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-xl cursor-pointer hover:bg-purple-50 hover:border-purple-500 transition">
                            <input type="checkbox" name="interests[]" value="cooking" class="w-4 h-4 text-purple-600">
                            <span class="text-gray-700"><i class="fas fa-utensils mr-2"></i>Cuisine</span>
                        </label>
                        <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-xl cursor-pointer hover:bg-purple-50 hover:border-purple-500 transition">
                            <input type="checkbox" name="interests[]" value="art" class="w-4 h-4 text-purple-600">
                            <span class="text-gray-700"><i class="fas fa-palette mr-2"></i>Art</span>
                        </label>
                        <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-xl cursor-pointer hover:bg-purple-50 hover:border-purple-500 transition">
                            <input type="checkbox" name="interests[]" value="tech" class="w-4 h-4 text-purple-600">
                            <span class="text-gray-700"><i class="fas fa-laptop mr-2"></i>Tech</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="terms" name="terms" required class="w-4 h-4 text-purple-600">
                    <label for="terms" class="ml-2 text-sm text-gray-600">
                        J'accepte les <a href="#" class="text-purple-600 hover:underline">conditions d'utilisation</a> et la <a href="#" class="text-purple-600 hover:underline">politique de confidentialité</a>
                    </label>
                </div>

                <button type="submit"
                    class="w-full gradient-bg text-white py-4 rounded-xl font-bold text-lg hover:shadow-lg transition transform hover:scale-[1.02]">
                    Créer mon compte
                </button>
            </form>

            <p class="mt-6 text-center text-gray-600">
                Vous avez déjà un compte ? 
                <a href="login.php" class="text-purple-600 font-medium hover:underline">Se connecter</a>
            </p>
        </div>

        <p class="mt-8 text-center text-gray-500 text-sm">
            <a href="../index.php" class="hover:text-purple-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>Retour à l'accueil
            </a>
        </p>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                alert('Les mots de passe ne correspondent pas !');
                return;
            }
            
            alert('Inscription réussie ! Redirection vers la page de connexion...');
            window.location.href = 'login.php';
        });
    </script>
</body>
</html>
