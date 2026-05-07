<?php
session_start();
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

require_login();

$page_title = 'Messages - SocialApp';
$current_user_id = $_SESSION['user_id'];
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
        .chat-container {
            height: calc(100vh - 180px);
        }
        .conversation-item.active {
            background-color: rgb(243 232 255);
            border-left: 4px solid rgb(147 51 234);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
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

    <div class="max-w-7xl mx-auto px-0">
        <div class="flex h-[calc(100vh-64px)]">
            <!-- Conversation List -->
            <div class="w-96 bg-white border-r border-gray-200 flex flex-col">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">Messages</h2>
                </div>
                <div class="p-4 border-b border-gray-200">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" id="search-conv" placeholder="Rechercher une conversation" 
                            class="w-full pl-10 pr-4 py-2 bg-gray-100 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none">
                    </div>
                </div>
                <div class="flex-1 overflow-y-auto" id="conversation-list">
                    <div class="p-4 text-center text-gray-500">
                        <i class="fas fa-spinner fa-spin text-2xl"></i>
                        <p class="mt-2">Chargement des conversations...</p>
                    </div>
                </div>
            </div>

            <!-- Chat Area -->
            <div class="flex-1 flex flex-col bg-white" id="chat-area">
                <div class="p-4 border-b border-gray-200 flex items-center justify-between" id="chat-header">
                    <div class="text-center text-gray-500 w-full">
                        <p>Sélectionnez une conversation pour commencer</p>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto p-6 bg-gray-50 space-y-4" id="messages-container">
                </div>

                <div class="p-4 border-t border-gray-200 hidden" id="message-input-container">
                    <form id="message-form" class="flex items-center gap-4">
                        <button type="button" class="text-gray-400 hover:text-purple-600 transition">
                            <i class="fas fa-paperclip text-xl"></i>
                        </button>
                        <button type="button" class="text-gray-400 hover:text-purple-600 transition">
                            <i class="far fa-smile text-xl"></i>
                        </button>
                        <input type="text" id="message-input" placeholder="Écrivez un message..." 
                            class="flex-1 px-4 py-3 bg-gray-100 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none">
                        <button type="submit" class="gradient-bg text-white w-12 h-12 rounded-xl flex items-center justify-center hover:shadow-lg transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const currentUserId = <?= $current_user_id ?>;
        let selectedUserId = null;
        let ws = null;

        document.addEventListener('DOMContentLoaded', function() {
            loadConversations();
            connectWebSocket();
        });

        function connectWebSocket() {
            ws = new WebSocket('ws://localhost:8080');
            
            ws.onopen = function() {
                console.log('Connecté au serveur WebSocket');
                ws.send(JSON.stringify({
                    type: 'register',
                    user_id: currentUserId
                }));
            };

            ws.onmessage = function(event) {
                const data = JSON.parse(event.data);
                if (data.type === 'message') {
                    if (selectedUserId === data.sender_id || selectedUserId === data.receiver_id) {
                        addMessageToChat(data);
                    }
                    if (selectedUserId !== data.sender_id) {
                        loadConversations();
                    }
                }
            };

            ws.onerror = function(error) {
                console.error('Erreur WebSocket:', error);
            };

            ws.onclose = function() {
                console.log('Déconnecté du serveur WebSocket');
                setTimeout(connectWebSocket, 3000);
            };
        }

        async function loadConversations() {
            try {
                const response = await fetch('../api/get_conversations.php');
                const result = await response.json();
                
                const list = document.getElementById('conversation-list');
                
                if (!result.success || result.conversations.length === 0) {
                    list.innerHTML = `
                        <div class="p-4 text-center text-gray-500">
                            <i class="fas fa-comments text-4xl mb-2"></i>
                            <p>Aucune conversation pour le moment</p>
                            <a href="discover.php" class="inline-block mt-4 text-purple-600 hover:underline">Découvrir des personnes</a>
                        </div>
                    `;
                    return;
                }

                list.innerHTML = result.conversations.map(conv => `
                    <div class="conversation-item flex items-center p-4 hover:bg-gray-50 cursor-pointer transition ${selectedUserId === conv.user_id ? 'active' : ''}" 
                         data-user-id="${conv.user_id}" onclick="selectConversation(${conv.user_id})">
                        <div class="relative">
                            <img src="${conv.avatar || 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=60&h=60&fit=crop&crop=face'}" 
                                 class="w-14 h-14 rounded-full object-cover">
                            ${conv.is_new_friend ? '<span class="absolute -top-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white flex items-center justify-center"><i class="fas fa-user-check text-white text-xs"></i></span>' : ''}
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex items-center justify-between">
                                <p class="font-semibold text-gray-900">${conv.name}</p>
                                <span class="text-gray-400 text-sm">${formatTime(conv.last_message_time)}</span>
                            </div>
                            <p class="text-gray-500 text-sm truncate ${conv.is_new_friend ? 'text-green-600' : ''}">${conv.last_message}</p>
                        </div>
                        ${!conv.is_read && !conv.is_sent ? '<span class="w-5 h-5 bg-purple-600 text-white text-xs rounded-full flex items-center justify-center">!</span>' : ''}
                    </div>
                `).join('');
            } catch (error) {
                console.error('Erreur lors du chargement des conversations:', error);
            }
        }

        async function selectConversation(userId) {
            selectedUserId = userId;
            document.querySelectorAll('.conversation-item').forEach(item => {
                item.classList.remove('active');
                if (parseInt(item.dataset.userId) === userId) {
                    item.classList.add('active');
                }
            });

            try {
                const response = await fetch(`../api/get_messages.php?user_id=${userId}`);
                const result = await response.json();

                if (result.success) {
                    document.getElementById('chat-header').innerHTML = `
                        <div class="flex items-center">
                            <img src="${result.other_user.avatar || 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=60&h=60&fit=crop&crop=face'}" 
                                 class="w-12 h-12 rounded-full object-cover">
                            <div class="ml-4">
                                <h3 class="font-bold text-gray-900">${result.other_user.name}</h3>
                                <p class="text-green-500 text-sm"><i class="fas fa-circle text-xs mr-1"></i>En ligne</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <button class="text-gray-400 hover:text-gray-600 transition"><i class="fas fa-phone"></i></button>
                            <button class="text-gray-400 hover:text-gray-600 transition"><i class="fas fa-video"></i></button>
                        </div>
                    `;

                    const container = document.getElementById('messages-container');
                    container.innerHTML = '';
                    result.messages.forEach(msg => addMessageToChat(msg));
                    container.scrollTop = container.scrollHeight;

                    document.getElementById('message-input-container').classList.remove('hidden');
                }
            } catch (error) {
                console.error('Erreur lors du chargement des messages:', error);
            }
        }

        function addMessageToChat(msg) {
            const container = document.getElementById('messages-container');
            const isCurrentUser = msg.sender_id == currentUserId;
            
            const div = document.createElement('div');
            div.className = `flex items-start gap-3 ${isCurrentUser ? 'justify-end' : ''}`;
            
            div.innerHTML = `
                ${!isCurrentUser ? `
                    <img src="${msg.sender_avatar || 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=40&h=40&fit=crop&crop=face'}" 
                         class="w-10 h-10 rounded-full object-cover flex-shrink-0">
                ` : ''}
                <div class="${isCurrentUser ? 'text-right' : ''}">
                    <div class="${isCurrentUser ? 'gradient-bg text-white' : 'bg-white'} p-4 rounded-2xl ${isCurrentUser ? 'rounded-tr-none' : 'rounded-tl-none'} shadow-sm max-w-md">
                        <p>${msg.content}</p>
                    </div>
                    <p class="text-gray-400 text-xs mt-1 ${isCurrentUser ? 'mr-2' : 'ml-2'}">${formatTime(msg.created_at)}</p>
                </div>
            `;
            
            container.appendChild(div);
            container.scrollTop = container.scrollHeight;
        }

        document.getElementById('message-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const input = document.getElementById('message-input');
            const content = input.value.trim();
            
            if (!content || !selectedUserId) return;

            const messageData = {
                type: 'message',
                sender_id: currentUserId,
                receiver_id: selectedUserId,
                content: content
            };

            if (ws && ws.readyState === WebSocket.OPEN) {
                ws.send(JSON.stringify(messageData));
            }

            input.value = '';
        });

        function formatTime(datetime) {
            if (!datetime) return '';
            const date = new Date(datetime);
            const now = new Date();
            const diff = now - date;
            
            if (diff < 60000) return 'À l\'instant';
            if (diff < 3600000) return Math.floor(diff / 60000) + ' min';
            if (diff < 86400000) return date.getHours().toString().padStart(2, '0') + ':' + date.getMinutes().toString().padStart(2, '0');
            return date.getDate().toString().padStart(2, '0') + '/' + (date.getMonth() + 1).toString().padStart(2, '0');
        }
    </script>
</body>
</html>
