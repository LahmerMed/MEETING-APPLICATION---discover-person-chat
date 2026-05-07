const API_BASE = '/projet php/api';

document.addEventListener('DOMContentLoaded', function() {
    console.log('Module chat chargé');
    initChat();
});

let currentUserId = null;

function initChat() {
    const messageForm = document.querySelector('#chatForm');
    if (messageForm) {
        messageForm.addEventListener('submit', handleSendMessage);
    }
}

async function loadMessages(userId) {
    currentUserId = userId;
    
    try {
        const response = await fetch(`${API_BASE}/get_messages.php?user_id=${userId}`);
        const data = await response.json();
        
        if (data.success) {
            renderMessages(data.messages);
        }
    } catch (error) {
        console.error('Erreur:', error);
    }
}

function renderMessages(messages) {
    const container = document.querySelector('#messagesContainer');
    if (!container) return;
    
    container.innerHTML = messages.map(msg => {
        const isSent = msg.sender_id === currentUserId; 
        
        return `
            <div class="flex items-start gap-3 ${isSent ? 'justify-end' : ''}">
                ${!isSent ? `<img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=40&h=40&fit=crop&crop=face" 
                         class="w-10 h-10 rounded-full object-cover flex-shrink-0">` : ''}
                <div class="${isSent ? 'text-right' : ''}">
                    <div class="${isSent ? 'gradient-bg text-white' : 'bg-white'} p-4 rounded-2xl ${isSent ? 'rounded-tr-none' : 'rounded-tl-none'} shadow-sm max-w-md">
                        <p>${msg.content}</p>
                    </div>
                    <p class="text-gray-400 text-xs mt-1 ${isSent ? 'mr-2' : 'ml-2'}">${new Date(msg.created_at).toLocaleTimeString('fr-FR')}</p>
                </div>
            </div>
        `;
    }).join('');
    
    container.scrollTop = container.scrollHeight;
}

async function handleSendMessage(e) {
    e.preventDefault();
    
    const input = e.target.querySelector('input[type="text"]');
    const content = input.value.trim();
    
    if (!content || !currentUserId) return;
    
    try {
        const formData = new FormData();
        formData.append('receiver_id', currentUserId);
        formData.append('content', content);
        
        const response = await fetch(`${API_BASE}/send_message.php`, {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            input.value = '';
            loadMessages(currentUserId);
        } else {
            alert(data.message);
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('Erreur lors de l\'envoi du message');
    }
}
