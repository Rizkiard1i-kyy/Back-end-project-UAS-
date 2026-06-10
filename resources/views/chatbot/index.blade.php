<!DOCTYPE html>
<html>
<head>
    <title>Asisten Akademik</title>
</head>
<body>

<h1>Asisten Akademik (LintarBot)</h1>

<a href="/dashboard">&larr; Kembali ke Dashboard</a>
<br><br>

<div id="chat-messages"
     style="height:400px; overflow-y:auto; border:1px solid #ccc; padding:10px; margin-bottom:10px; background:#fafafa;">

    <div><strong>Bot:</strong> Halo! Saya LintarBotBot, asisten akademik virtual Anda. Ada yang bisa saya bantu?</div>

</div>

<div>
    <input
        type="text"
        id="chat-input"
        placeholder="Ketik pertanyaan..."
        style="width:70%; padding:6px;"
        onkeydown="if(event.key==='Enter') sendChat()">

    <button onclick="sendChat()" style="padding:6px 14px;">Kirim</button>
    <button onclick="clearHistory()" style="padding:6px 14px; margin-left:6px; color:red;">Hapus Chat</button>
</div>

<br>
<small style="color:gray;">Tekan Enter untuk kirim</small>

<script>
const box   = document.getElementById('chat-messages');
const input = document.getElementById('chat-input');


window.onload = async function () {
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
        // biarkan pesan default tampil
    }
};

function appendMessage(role, text) {
    var label = (role === 'user') ? 'Anda' : 'Bot';
    var div   = document.createElement('div');
    div.innerHTML = '<strong>' + label + ':</strong> ' + escapeHtml(text);
    div.style.marginBottom = '6px';
    box.appendChild(div);
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
    typingDiv.innerHTML = '<em style="color:gray;">Bot sedang mengetik...</em>';
    box.appendChild(typingDiv);
    box.scrollTop = box.scrollHeight;

    try {
        var res  = await fetch('{{ route("chatbot.ask") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: msg })
        });

        var data = await res.json();

        document.getElementById('typing').remove();

        appendMessage('bot', data.answer || 'Terjadi kesalahan pada server.');

    } catch (e) {
        document.getElementById('typing').remove();
        appendMessage('bot', 'Gagal menghubungi server.');
        console.error(e);
    }

    box.scrollTop = box.scrollHeight;
}

async function clearHistory() {
    if (!confirm('Hapus semua riwayat chat?')) return;

    try {
        await fetch('{{ route("chatbot.clear") }}', {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        });
        box.innerHTML = '<div><strong>Bot:</strong> Riwayat chat dihapus. Ada yang bisa saya bantu?</div>';
    } catch (e) {
        alert('Gagal menghapus riwayat.');
    }
}
</script>

</body>
</html>
