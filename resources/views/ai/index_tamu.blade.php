<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AI Concierge - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --gold: #d4af37;
            --gold-light: #f3e5ab;
            --bg: linear-gradient(135deg, #041026 0%, #08172f 50%, #0d2347 100%);
            --surface: rgba(255,255,255,.04);
            --surface-hover: rgba(255,255,255,.07);
            --border: rgba(255,255,255,.08);
            --text: #ffffff;
            --text-secondary: #90a0b7;
        }

        body {
            background: var(--bg);
            min-height: 100vh;
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            overflow: hidden;
        }

        .main {
            flex: 1;
            margin-left: 260px;
            padding: 32px;
            overflow-y: auto;
        }

        .page-header { margin-bottom: 28px; }

        .page-header h1 {
            font-family: 'Cinzel', serif;
            font-size: 44px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 10px;
        }

        .page-header p { color: var(--text-secondary); font-size: 16px; }

        /* TAB */
        .tab-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
        }

        .tab-btn {
            padding: 10px 24px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,.08);
            background: rgba(255,255,255,.03);
            color: var(--text-secondary);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: .2s;
        }

        .tab-btn.active,
        .tab-btn:hover {
            background: rgba(212,175,55,.12);
            border-color: rgba(212,175,55,.3);
            color: var(--gold-light);
        }

        /* CHAT LAYOUT */
        .chat-layout {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 24px;
            height: calc(100vh - 200px);
        }

        .glass {
            background: var(--surface);
            border: 1px solid var(--border);
            backdrop-filter: blur(14px);
            border-radius: 28px;
            overflow: hidden;
        }

        /* SIDEBAR AI */
        .sidebar-ai {
            padding: 28px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            position: relative;
            z-index: 10;
        }

        .sidebar-ai h3 {
            color: var(--gold);
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .quick-btn {
            width: 100%;
            padding: 14px 18px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,.06);
            background: rgba(255,255,255,.03);
            color: white;
            text-align: left;
            transition: .25s;
            cursor: pointer;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .quick-btn:hover {
            background: rgba(212,175,55,.12);
            border-color: rgba(212,175,55,.28);
            transform: translateY(-2px);
        }

        /* CHAT BOX */
        .chat-box {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .chat-top {
            padding: 22px 28px;
            border-bottom: 1px solid rgba(255,255,255,.05);
            background: linear-gradient(90deg, rgba(212,175,55,.08), transparent);
        }

        .chat-top h2 { font-size: 17px; color: white; }

        .chat-top p {
            color: var(--text-secondary);
            margin-top: 5px;
            font-size: 13px;
        }

        .online-dot {
            display: inline-block;
            width: 7px;
            height: 7px;
            background: #22c55e;
            border-radius: 50%;
            margin-right: 6px;
        }

        .messages {
            flex: 1;
            overflow-y: auto;
            padding: 28px;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .messages::-webkit-scrollbar { width: 4px; }
        .messages::-webkit-scrollbar-thumb { background: rgba(255,255,255,.08); border-radius: 20px; }

        .message {
            max-width: 75%;
            padding: 16px 20px;
            line-height: 1.7;
            font-size: 14px;
        }

        .ai-message {
            align-self: flex-start;
            background: linear-gradient(135deg, rgba(212,175,55,.12), rgba(255,255,255,.04));
            border: 1px solid rgba(212,175,55,.18);
            border-radius: 22px 22px 22px 6px;
        }

        .user-message {
            align-self: flex-end;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.05);
            border-radius: 22px 22px 6px 22px;
        }

        .msg-time {
            font-size: 11px;
            color: rgba(255,255,255,.25);
            margin-top: 6px;
        }

        .typing {
            display: none;
            align-self: flex-start;
            padding: 14px 20px;
            background: linear-gradient(135deg, rgba(212,175,55,.10), rgba(255,255,255,.03));
            border: 1px solid rgba(212,175,55,.15);
            border-radius: 22px 22px 22px 6px;
            gap: 5px;
        }

        .typing.show { display: flex; }

        .typing span {
            width: 7px; height: 7px;
            background: var(--gold);
            border-radius: 50%;
            animation: bounce 1.2s infinite;
        }

        .typing span:nth-child(2) { animation-delay: .2s; }
        .typing span:nth-child(3) { animation-delay: .4s; }

        @keyframes bounce {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-6px); }
        }

        .input-area {
            padding: 20px 24px;
            border-top: 1px solid rgba(255,255,255,.05);
            display: flex;
            gap: 14px;
            background: rgba(0,0,0,.12);
        }

        .input-area input {
            flex: 1;
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,255,255,.08);
            outline: none;
            color: white;
            padding: 16px 20px;
            border-radius: 16px;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: border-color .2s;
        }

        .input-area input:focus { border-color: rgba(212,175,55,.4); }
        .input-area input::placeholder { color: #7f93b0; }

        .send-btn {
            background: linear-gradient(135deg, #c99a2e, #d4af37);
            color: #041026;
            border: none;
            padding: 0 26px;
            border-radius: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: .25s;
            font-size: 15px;
        }

        .send-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(212,175,55,.25);
        }

        /* REKOMENDASI TAB */
        .rekom-layout { display: none; height: calc(100vh - 200px); gap: 24px; }
        .rekom-layout.show { display: grid; grid-template-columns: 320px 1fr; }

        .rekom-form-panel {
            padding: 28px;
            display: flex;
            flex-direction: column;
            gap: 18px;
            overflow-y: auto;
        }

        .rekom-form-panel h3 {
            color: var(--gold);
            font-size: 16px;
            font-weight: 600;
        }

        .form-group { display: flex; flex-direction: column; gap: 8px; }

        .form-label {
            font-size: 12px;
            color: var(--text-secondary);
            font-weight: 600;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .form-input {
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 12px;
            padding: 12px 16px;
            color: white;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            outline: none;
            width: 100%;
            transition: border-color .2s;
        }

        .form-input:focus { border-color: rgba(212,175,55,.4); }

        .chip-group { display: flex; flex-wrap: wrap; gap: 8px; }

        .chip-label { cursor: pointer; }
        .chip-label input { display: none; }

        .chip {
            padding: 7px 14px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,.1);
            background: rgba(255,255,255,.04);
            color: var(--text-secondary);
            font-size: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: .2s;
        }

        .chip-label input:checked + .chip {
            background: rgba(212,175,55,.15);
            border-color: rgba(212,175,55,.4);
            color: var(--gold-light);
        }

        .btn-rekom {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #c99a2e, #d4af37);
            color: #041026;
            border: none;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: .25s;
        }

        .btn-rekom:hover { filter: brightness(1.08); transform: translateY(-1px); }
        .btn-rekom:disabled { opacity: .6; cursor: not-allowed; transform: none; }

        .rekom-result-panel {
            padding: 28px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            overflow-y: auto;
        }

        .rekom-result-panel h3 {
            color: var(--gold);
            font-size: 16px;
            font-weight: 600;
        }

        .rekom-empty {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,.2);
            gap: 12px;
            text-align: center;
        }

        .rekom-empty i { font-size: 3rem; }
        .rekom-empty p { font-size: 14px; }

        .rekom-output {
            display: none;
            background: linear-gradient(135deg, rgba(212,175,55,.08), rgba(255,255,255,.03));
            border: 1px solid rgba(212,175,55,.15);
            border-radius: 20px;
            padding: 24px;
            font-size: 14px;
            line-height: 1.8;
            color: #e2e8f0;
        }

        .rekom-output.show { display: block; }

        .loading-bar {
            display: none;
            height: 2px;
            background: rgba(255,255,255,.06);
            border-radius: 2px;
            overflow: hidden;
        }

        .loading-bar.show { display: block; }
        .loading-bar::after {
            content: '';
            display: block;
            height: 100%;
            width: 40%;
            background: var(--gold);
            animation: slide 1.2s infinite ease-in-out;
        }

        @keyframes slide {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(350%); }
        }

        @media (max-width: 1100px) {
            .chat-layout, .rekom-layout { grid-template-columns: 1fr; }
            .sidebar-ai { display: none; }
            .rekom-form-panel { display: none; }
        }

        @media (max-width: 768px) {
            .main { margin-left: 0; padding: 18px; }
            .page-header h1 { font-size: 32px; }
            .message { max-width: 100%; }
        }
    </style>
</head>

<body>

@include('layouts.sidebar-guest')

<div class="main">

    <div class="page-header">
        <h1>AI Concierge</h1>
        <p>Smart assistant siap membantu Anda — kamar, reservasi, dan rekomendasi</p>
    </div>

    {{-- TAB BAR --}}
    <div class="tab-bar">
        <button class="tab-btn active" onclick="switchTab('chat', this)">
            <i class="fas fa-comments"></i> Chat Asisten
        </button>
        <button class="tab-btn" onclick="switchTab('rekom', this)">
            <i class="fas fa-star"></i> Rekomendasi Kamar
        </button>
    </div>

    {{-- ── CHAT TAB ── --}}
    <div class="chat-layout" id="tabChat">

        {{-- Quick Buttons --}}
        <div class="sidebar-ai glass">
            <h3>Quick Assistance</h3>
            <button type="button" class="quick-btn" onclick="sendQuick('Kamar apa yang tersedia hari ini?')">🛏️ Kamar tersedia hari ini</button>
            <button type="button" class="quick-btn" onclick="sendQuick('Apa saja fasilitas hotel?')">🏊 Fasilitas hotel</button>
            <button type="button" class="quick-btn" onclick="sendQuick('Lihat status reservasi saya')">📅 Status reservasi saya</button>
            <button type="button" class="quick-btn" onclick="sendQuick('Berapa harga kamar termurah?')">💳 Info harga kamar</button>
            <button type="button" class="quick-btn" onclick="sendQuick('Jam berapa breakfast tersedia?')">🍽️ Jam breakfast</button>
            <button type="button" class="quick-btn" onclick="sendQuick('Apakah ada layanan antar jemput bandara?')">🚕 Layanan airport pickup</button>
            <button type="button" class="quick-btn" onclick="sendQuick('Bagaimana cara membatalkan reservasi?')">🧾 Bantuan reservasi</button>
        </div>

        {{-- Chat Box --}}
        <div class="chat-box glass">
            <div class="chat-top">
                <h2><span class="online-dot"></span>AnoHotel AI Concierge</h2>
                <p>Tanya soal kamar, reservasi, fasilitas, atau rekomendasi</p>
            </div>

            <div class="messages" id="messages">
                <div class="message ai-message">
                    Selamat datang di AnoHotel, <strong>{{ auth()->user()->name }}</strong>! ✨<br>
                    Ada yang bisa saya bantu hari ini?
                </div>

                <div class="typing" id="typing">
                    <span></span><span></span><span></span>
                </div>
            </div>

            <div class="input-area">
                <input type="text" id="chatInput" placeholder="Tanya AnoHotel AI..."
                    onkeydown="if(event.key==='Enter') sendChat()" />
                <button class="send-btn" onclick="sendChat()">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>

    </div>

    {{-- ── REKOMENDASI TAB ── --}}
    <div class="rekom-layout" id="tabRekom">

        {{-- Form --}}
        <div class="rekom-form-panel glass">
            <h3><i class="fas fa-sliders"></i> Filter Pencarian</h3>

            <div class="form-group">
                <label class="form-label">Jumlah Tamu</label>
                <input type="number" class="form-input" id="rJumlah" min="1" max="10" value="2" />
            </div>

            <div class="form-group">
                <label class="form-label">Budget per Malam (Rp)</label>
                <input type="number" class="form-input" id="rBudget" placeholder="Contoh: 1500000" step="100000" />
            </div>

            <div class="form-group">
                <label class="form-label">Tipe Kamar</label>
                <select class="form-input" id="rTipe">
                    <option value="">Semua tipe</option>
                    <option value="standard">Standard</option>
                    <option value="deluxe">Deluxe</option>
                    <option value="suite">Suite</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Preferensi</label>
                <div class="chip-group">
                    @foreach(['Non-smoking','View taman','Lantai tinggi','Bathtub','Sarapan termasuk','King bed','Honeymoon','Family'] as $pref)
                    <label class="chip-label">
                        <input type="checkbox" name="pref" value="{{ strtolower($pref) }}">
                        <span class="chip">{{ $pref }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="loading-bar" id="loadingRekom"></div>

            <button class="btn-rekom" id="btnRekom" onclick="cariRekomendasi()">
                <i class="fas fa-wand-magic-sparkles"></i> Cari Rekomendasi AI
            </button>
        </div>

        {{-- Result --}}
        <div class="rekom-result-panel glass">
            <h3><i class="fas fa-star"></i> Rekomendasi AI</h3>

            <div class="rekom-empty" id="rekEmpty">
                <i class="fas fa-robot"></i>
                <p>Isi filter di kiri dan klik<br><strong>Cari Rekomendasi AI</strong></p>
            </div>

            <div class="rekom-output" id="rekOutput"></div>
        </div>

    </div>

</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

function nowTime() {
    return new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
}

// ── TAB SWITCH ──
function switchTab(tab, btn) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('tabChat').style.display  = tab === 'chat'  ? '' : 'none';
    document.getElementById('tabRekom').style.display = tab === 'rekom' ? '' : 'none';
    if (tab === 'rekom') {
        document.getElementById('tabRekom').classList.add('show');
    }
}

// ── CHAT ──
function appendMsg(role, text) {
    const box = document.getElementById('messages');
    const typing = document.getElementById('typing');
    const div = document.createElement('div');
    div.className = `message ${role === 'user' ? 'user-message' : 'ai-message'}`;
    div.innerHTML = `${text.replace(/\n/g, '<br>')}<div class="msg-time">${nowTime()}</div>`;
    box.insertBefore(div, typing);
    box.scrollTop = box.scrollHeight;
}

function showTyping(show) {
    const t = document.getElementById('typing');
    t.classList.toggle('show', show);
    document.getElementById('messages').scrollTop = 9999;
}

async function sendChat() {
    const input = document.getElementById('chatInput');
    const msg = input.value.trim();
    if (!msg) return;
    input.value = '';
    appendMsg('user', msg);
    showTyping(true);

    try {
        const res = await fetch('{{ route("ai.tamu.chat") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ message: msg })
        });
        const data = await res.json();
        showTyping(false);
        appendMsg('ai', data.reply ?? 'Maaf, terjadi kesalahan. Silakan coba lagi.');
    } catch {
        showTyping(false);
        appendMsg('ai', 'Koneksi bermasalah. Silakan coba lagi.');
    }
}

function sendQuick(text) {
    console.log("Quick button clicked: ", text);
    const input = document.getElementById('chatInput');
    if (input) {
        input.value = text;
        sendChat();
    } else {
        console.error("chatInput element not found!");
    }
}

// ── REKOMENDASI ──
async function cariRekomendasi() {
    const btn = document.getElementById('btnRekom');
    const loading = document.getElementById('loadingRekom');
    const output = document.getElementById('rekOutput');
    const empty = document.getElementById('rekEmpty');
    const prefs = [...document.querySelectorAll('input[name="pref"]:checked')].map(e => e.value);

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mencari...';
    loading.classList.add('show');
    output.classList.remove('show');
    empty.style.display = 'none';

    try {
        const res = await fetch('{{ route("ai.tamu.rekomendasi") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({
                jumlah_tamu: document.getElementById('rJumlah').value,
                budget: document.getElementById('rBudget').value || null,
                preferensi: prefs
            })
        });
        const data = await res.json();
        output.innerHTML = (data.rekomendasi ?? 'Tidak ada hasil.').replace(/\n/g, '<br>');
        output.classList.add('show');
    } catch {
        output.innerHTML = 'Gagal mendapatkan rekomendasi. Coba lagi.';
        output.classList.add('show');
    } finally {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-wand-magic-sparkles"></i> Cari Rekomendasi AI';
        loading.classList.remove('show');
    }
}
</script>

</body>
</html>