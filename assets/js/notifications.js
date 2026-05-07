const API_BASE = '/projet php/api';

document.addEventListener('DOMContentLoaded', function() {
    console.log('Module notifications chargé');
    loadNotifications();
});

async function loadNotifications() {
    try {
        const response = await fetch(`${API_BASE}/get_notifications.php`);
        const data = await response.json();
        
        if (data.success) {
            updateNotificationBadge(data.unread_count);
            renderNotifications(data.notifications);
        }
    } catch (error) {
        console.error('Erreur:', error);
    }
}

function updateNotificationBadge(count) {
    const badge = document.querySelector('#notif-count, #invites-count');
    if (badge) {
        if (count > 0) {
            badge.textContent = count;
            badge.classList.remove('hidden');
        } else {
            badge.classList.add('hidden');
        }
    }
}

function renderNotifications(notifications) {
    const container = document.querySelector('#notificationsContainer');
    if (!container) return;
    
    if (notifications.length === 0) {
        container.innerHTML = '<p class="text-gray-500 text-center py-8">Aucune notification</p>';
        return;
    }
    
    container.innerHTML = notifications.map(notif => {
        let iconClass = 'fa-bell';
        let bgClass = 'bg-blue-100 text-blue-600';
        
        if (notif.type === 'invitation') {
            iconClass = 'fa-user-plus';
            bgClass = 'bg-purple-100 text-purple-600';
        } else if (notif.type === 'message') {
            iconClass = 'fa-comment';
            bgClass = 'bg-pink-100 text-pink-600';
        } else if (notif.type === 'accepted') {
            iconClass = 'fa-check';
            bgClass = 'bg-green-100 text-green-600';
        }
        
        return `
            <div class="flex items-start gap-4 p-4 ${notif.is_read ? 'opacity-75' : 'bg-purple-50'} rounded-xl">
                <div class="w-12 h-12 ${bgClass} rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas ${iconClass} text-xl"></i>
                </div>
                <div class="flex-1">
                    <p class="text-gray-800">${notif.message}</p>
                    <p class="text-gray-500 text-sm mt-1">${new Date(notif.created_at).toLocaleString('fr-FR')}</p>
                </div>
            </div>
        `;
    }).join('');
}

setInterval(loadNotifications, 30000);
