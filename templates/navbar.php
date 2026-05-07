<nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-xl">
                    S
                </div>
                <span class="font-bold text-2xl">SocialApp</span>
            </div>

            <!-- Search -->
            <div class="flex-1 max-w-md mx-8">
                <input type="text" id="search-input"
                       class="w-full bg-gray-100 dark:bg-gray-700 border-0 rounded-full py-2.5 px-5 focus:ring-2 focus:ring-blue-500 outline-none"
                       placeholder="Rechercher des utilisateurs...">
            </div>

            <!-- Icons -->
            <div class="flex items-center gap-6">
                <a href="/public/discover.php" class="hover:text-blue-500 transition">Découvrir</a>
                
                <a href="/public/invitations.php" class="relative hover:text-blue-500 transition">
                    Invitations
                    <span id="invites-count" class="hidden absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
                </a>

                <button @click="showNotifications = !showNotifications" class="relative hover:text-blue-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-9-5.197V8.5m.002 3.5L12 15l-3-3" />
                    </svg>
                    <span id="notif-count" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
                </button>

                <a href="/public/chat.php" class="hover:text-blue-500 transition">Messages</a>

                <!-- Profile Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-2">
                        <img src="<?= $_SESSION['avatar'] ?? '/assets/uploads/default.jpg' ?>" 
                             class="w-8 h-8 rounded-full object-cover border-2 border-white shadow">
                        <span class="font-medium"><?= $_SESSION['username'] ?? 'Utilisateur' ?></span>
                    </button>
                    
                    <div x-show="open" @click.outside="open = false"
                         class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-xl py-2 z-50">
                        <a href="/public/profile.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Profil</a>
                        <a href="/public/dashboard.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Tableau de bord</a>
                        <hr class="my-1">
                        <a href="/admin/index.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Administration</a>
                        <a href="/public/logout.php" class="block px-4 py-2 text-red-500 hover:bg-gray-100 dark:hover:bg-gray-700">Déconnexion</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>