const API_BASE = '/projet php/api';

document.addEventListener('DOMContentLoaded', function() {
    console.log('SocialApp chargée');
    
    initForms();
    initQuickActions();
});

function initForms() {
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }
    
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', handleRegister);
    }
}

async function handleLogin(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    
    try {
        const response = await fetch(`${API_BASE}/login.php`, {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert(data.message);
            window.location.href = data.redirect || '/projet php/public/dashboard.php';
        } else {
            alert(data.message);
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('Une erreur est survenue');
    }
}

async function handleRegister(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    
    try {
        const response = await fetch(`${API_BASE}/register.php`, {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert(data.message);
            window.location.href = '/projet php/public/login.php';
        } else {
            alert(data.message);
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('Une erreur est survenue');
    }
}

async function sendInvitation(userId) {
    try {
        const formData = new FormData();
        formData.append('receiver_id', userId);
        
        const response = await fetch(`${API_BASE}/send_invitation.php`, {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        alert(data.message);
        
        if (data.success) {
            location.reload();
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('Erreur lors de l\'envoi de l\'invitation');
    }
}

async function blockUser(userId) {
    if (!confirm('Êtes-vous sûr de vouloir bloquer cet utilisateur ?')) {
        return;
    }
    
    try {
        const formData = new FormData();
        formData.append('blocked_id', userId);
        
        const response = await fetch(`${API_BASE}/block_user.php`, {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        alert(data.message);
        
        if (data.success) {
            location.reload();
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('Erreur lors du blocage');
    }
}

async function reportUser(userId, reason) {
    try {
        const formData = new FormData();
        formData.append('reported_id', userId);
        formData.append('reason', reason);
        formData.append('type', 'user');
        
        const response = await fetch(`${API_BASE}/report_user.php`, {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        alert(data.message);
    } catch (error) {
        console.error('Erreur:', error);
        alert('Erreur lors du signalement');
    }
}

function initQuickActions() {
}
