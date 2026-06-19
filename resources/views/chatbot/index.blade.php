<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lintar Bot - Asisten Akademik Virtual</title>
    <link rel="stylesheet" href="{{ asset('css/aset.css') }}">
</head>
<body>
<header class="topbar">
    <div class="brand">
        <div class="brand-mark">
            <img src="{{ asset('images/logo-untar.png') }}" alt="Logo UNTAR">
        </div>
        <h1>Halo! Selamat datang {{ auth()->user()->nama ?? 'User' }} di Lintar X!</h1>
    </div>
</header>
<div class="container">
    <div class="page-header">
        <h1>Lintar Bot</h1>
    </div>
    <div class="chat-card">
        <div class="chat-card-header">
            <div class="chat-card-title">
                <div class="chat-status-indicator"></div>
                <div>
                    <h2>Asisten Akademik Virtual</h2>
                    <p>Lintar Bot • Siap membantu perkuliahan Anda</p>
                </div>
            </div>
        </div>
        <div class="chat-messages-container" id="chat-messages">
        </div>
        <div class="chat-input-area">
            <div class="glowing-input-wrapper" id="input-glow-wrapper">
                <div class="chat-input-box">
                    <input
                        type="text"
                        id="chat-input"
                        class="chat-input-field"
                        placeholder="Ketik pertanyaan Anda di sini..."
                        onkeydown="if(event.key==='Enter') sendChat()"
                        onfocus="toggleInputGlow(true)"
                        onblur="toggleInputGlow(false)"
                    >
                    
                    <button onclick="sendChat()" class="chat-action-btn btn-send-chat">
                        <span>Kirim</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>
                    
                    <button onclick="clearHistory()" class="chat-action-btn btn-clear-chat">
                        <span>Hapus Chat</span>
                    </button>
                </div>
            </div>
            <div class="chat-tips">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <span>Tekan Enter untuk mengirim pertanyaan.</span>
            </div>
        </div>
    </div>
    <a href="/dashboard" class="btn-back">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Kembali Ke Dashboard
    </a>
</div>
<script>
const box   = document.getElementById('chat-messages');
const input = document.getElementById('chat-input');
const glowWrapper = document.getElementById('input-glow-wrapper');
const userSvg = `
    <svg viewBox="0 0 24 24" fill="none" stroke="#8b2635" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
        <circle cx="12" cy="7" r="4"></circle>
    </svg>
`;
const botSvg = `
    <svg viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
        <path d="M2 17l10 5 10-5"></path>
        <path d="M2 12l10 5 10-5"></path>
    </svg>
`;
window.onload = async function () {
    appendWelcomeMessage();
    try {
        const res  = await fetch('{{ route("chatbot.history") }}');
        const data = await res.json();
        if (data.success && data.history.length > 0) {
            box.innerHTML = ''; 
            data.history.forEach(function(item) {
                appendMessage(item.role, item.message);
            });
            box.scrollTop = box.scrollHeight;
        }
    } catch (e) {
    }
};
function appendWelcomeMessage() {
    appendMessage('bot', 'Halo! Saya LintarBot, asisten akademik virtual Anda. Ada yang bisa saya bantu?');
}
function toggleInputGlow(active) {
    if (active) {
        glowWrapper.classList.add('active-glow');
    } else {
        glowWrapper.classList.remove('active-glow');
    }
}
function appendMessage(role, text) {
    const isUser = (role === 'user');
    const label = isUser ? 'Anda' : 'Bot';
    const messageClass = isUser ? 'user-message' : 'bot-message';
    
    const div = document.createElement('div');
    div.className = 'message-item ' + messageClass;
    

    const avatar = document.createElement('div');
    avatar.className = 'avatar-wrapper';
    

    if (isUser) {
        avatar.innerHTML = userSvg;
    } else {
        avatar.innerHTML = '<img src="{{ asset('images/Ai-Bot.png') }}" alt="LintarBot" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">';
    }
    
    const bubbleWrapper = document.createElement('div');
    bubbleWrapper.className = 'message-bubble-wrapper';
    
    const nameLabel = document.createElement('span');
    nameLabel.className = 'message-sender';
    nameLabel.innerText = label;
    bubbleWrapper.appendChild(nameLabel);
    
    const bubble = document.createElement('div');
    bubble.className = 'message-bubble';
    bubble.innerHTML = escapeHtml(text);
    bubbleWrapper.appendChild(bubble);
    
    div.appendChild(avatar);
    div.appendChild(bubbleWrapper);
    
    box.appendChild(div);
    box.scrollTop = box.scrollHeight;
}
function escapeHtml(text) {
    return text
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');
}
async function sendChat() {
    var msg = input.value.trim();
    if (!msg) return;
    appendMessage('user', msg);
    input.value = '';
    box.scrollTop = box.scrollHeight;

    var typingDiv = document.createElement('div');
    typingDiv.id  = 'typing';
    typingDiv.className = 'message-item bot-message';
    typingDiv.innerHTML = `
        <div class="avatar-wrapper">
            <img src="{{ asset('images/Ai-Bot.png') }}" alt="LintarBot" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
        </div>
        <div class="message-bubble-wrapper">
            <span class="message-sender">Bot</span>
            <div class="typing-container">
                <div class="typing-dots">
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                </div>
            </div>
        </div>
    `;
    
    box.appendChild(typingDiv);
    box.scrollTop = box.scrollHeight;
    try {
        var res  = await fetch('{{ route("chatbot.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: msg })
        });
        var data = await res.json();
        const typingEl = document.getElementById('typing');
        if (typingEl) typingEl.remove();
        appendMessage('bot', data.answer || 'Terjadi kesalahan pada server.');
    } catch (e) {
        const typingEl = document.getElementById('typing');
        if (typingEl) typingEl.remove();
        
        appendMessage('bot', 'Gagal menghubungi server.');
        console.error(e);
    }
    box.scrollTop = box.scrollHeight;
}
async function clearHistory() {
    if (!confirm('Hapus semua riwayat chat?')) return;
    try {
        await fetch('{{ route("chatbot.destroy") }}', {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        });
        box.innerHTML = '';
        appendWelcomeMessage();
    } catch (e) {
        alert('Gagal menghapus riwayat.');
    }
}
</script>
</body>
</html>