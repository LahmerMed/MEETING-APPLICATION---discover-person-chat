<?php
session_start();
$page_title = 'Connexion - SocialApp';
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
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <a href="../index.php" class="inline-flex items-center">
                <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center text-white font-bold text-2xl">S</div>
                <span class="ml-3 text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">SocialApp</span>
            </a>
            <h2 class="mt-8 text-3xl font-bold text-gray-900">Se connecter</h2>
            <p class="mt-2 text-gray-600">Ravis de vous revoir ! Connectez-vous à votre compte</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form id="loginForm" class="space-y-6">
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

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-purple-600">
                        <label for="remember" class="ml-2 text-sm text-gray-600">Se souvenir de moi</label>
                    </div>
                    <a href="#" class="text-sm text-purple-600 hover:underline">Mot de passe oublié ?</a>
                </div>

                <button type="submit"
                    class="w-full gradient-bg text-white py-4 rounded-xl font-bold text-lg hover:shadow-lg transition transform hover:scale-[1.02]">
                    Se connecter
                </button>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Ou continuer avec</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-4">
                    <button class="flex items-center justify-center gap-2 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition">
                        <i class="fab fa-google text-red-500"></i>
                        <span class="font-medium text-gray-700">Google</span>
                    </button>
                    <button class="flex items-center justify-center gap-2 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition">
                        <i class="fab fa-facebook text-blue-600"></i>
                        <span class="font-medium text-gray-700">Facebook</span>
                    </button>
                </div>
            </div>

            <p class="mt-8 text-center text-gray-600">
                Vous n'avez pas de compte ? 
                <a href="register.php" class="text-purple-600 font-medium hover:underline">Créer un compte</a>
            </p>
        </div>

        <p class="mt-8 text-center text-gray-500 text-sm">
            <a href="../index.php" class="hover:text-purple-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>Retour à l'accueil
            </a>
        </p>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            try {
                const response = await fetch('../api/login.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    alert(result.message);
                    window.location.href = 'dashboard.php';
                } else {
                    alert(result.message);
                }
            } catch (error) {
                alert('Erreur de connexion. Veuillez réessayer.');
            }
        });
    </script>
</body>
</html>
