<?php
session_start();
$page_title = 'Accueil - SocialApp';
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
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="w-10 h-10 gradient-bg rounded-xl flex items-center justify-center text-white font-bold text-xl">
                            S
                        </div>
                        <span class="ml-3 text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">SocialApp</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="public/dashboard.php" class="text-gray-700 hover:text-purple-600 px-4 py-2 rounded-lg font-medium transition">Tableau de bord</a>
                        <a href="public/logout.php" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-2 rounded-full font-medium hover:shadow-lg transition">Déconnexion</a>
                    <?php else: ?>
                        <a href="public/login.php" class="text-gray-700 hover:text-purple-600 px-4 py-2 rounded-lg font-medium transition">Connexion</a>
                        <a href="public/register.php" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-2 rounded-full font-medium hover:shadow-lg transition">Inscription</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">Rencontrez des personnes qui partagent vos centres d'intérêt</h1>
                <p class="text-xl md:text-2xl mb-10 opacity-90">Connectez-vous, discutez, et créez des liens authentiques avec des personnes près de chez vous.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="public/register.php" class="bg-white text-purple-600 px-10 py-4 rounded-full font-bold text-lg hover:shadow-2xl transition transform hover:scale-105">Commencer gratuitement</a>
                    <a href="#features" class="border-2 border-white text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-purple-600 transition">Découvrir les fonctionnalités</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl md:text-5xl font-bold text-purple-600">10K+</div>
                    <div class="text-gray-600 mt-2">Utilisateurs actifs</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-bold text-pink-600">50K+</div>
                    <div class="text-gray-600 mt-2">Connexions créées</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-bold text-indigo-600">100K+</div>
                    <div class="text-gray-600 mt-2">Messages échangés</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-bold text-purple-600">98%</div>
                    <div class="text-gray-600 mt-2">Satisfaction</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Fonctionnalités puissantes</h2>
                <p class="text-xl text-gray-600">Tout ce dont vous avez besoin pour rencontrer des personnes incroyables</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover">
                    <div class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-search text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Découverte intelligente</h3>
                    <p class="text-gray-600">Trouvez des personnes qui partagent vos centres d'intérêt grâce à nos filtres avancés (âge, ville, intérêts, sexe).</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-rose-500 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-comments text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Chat en temps réel</h3>
                    <p class="text-gray-600">Discutez instantanément avec les personnes que vous aimez grâce à notre système de messagerie en temps réel (WebSocket).</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-user-circle text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Profil personnalisable</h3>
                    <p class="text-gray-600">Créez un profil unique avec votre photo, bio, centres d'intérêt et contrôlez votre visibilité (public/privé).</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-bell text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Notifications</h3>
                    <p class="text-gray-600">Recevez des notifications en temps réel pour les nouvelles invitations, messages et acceptations d'invitation.</p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Sécurité et confidentialité</h3>
                    <p class="text-gray-600">Bloquez les utilisateurs indésirables, signalez les comportements inappropriés et gardez le contrôle sur votre expérience.</p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-violet-500 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-users text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Gestion des invitations</h3>
                    <p class="text-gray-600">Envoyez et recevez des invitations, acceptez ou refusez, et suivez l'état de vos demandes de connexion.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 gradient-bg text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">Prêt à commencer l'aventure ?</h2>
            <p class="text-xl mb-10 opacity-90">Rejoignez des milliers de personnes qui ont déjà trouvé des amis, des partenaires et des moments inoubliables.</p>
            <a href="public/register.php" class="bg-white text-purple-600 px-12 py-5 rounded-full font-bold text-xl hover:shadow-2xl transition transform hover:scale-105 inline-block">Créer mon compte gratuitement</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 gradient-bg rounded-xl flex items-center justify-center text-white font-bold text-xl">S</div>
                        <span class="ml-3 text-xl font-bold text-white">SocialApp</span>
                    </div>
                    <p class="text-gray-500">Rencontrez des personnes incroyables et créez des liens durables.</p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Liens rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">À propos</a></li>
                        <li><a href="#" class="hover:text-white transition">Fonctionnalités</a></li>
                        <li><a href="#" class="hover:text-white transition">Tarifs</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Légal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">Conditions d'utilisation</a></li>
                        <li><a href="#" class="hover:text-white transition">Politique de confidentialité</a></li>
                        <li><a href="#" class="hover:text-white transition">Cookies</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Suivez-nous</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center">
                <p>&copy; 2024 SocialApp. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>
