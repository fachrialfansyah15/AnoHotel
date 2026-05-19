<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Asisten Resepsionis - AnoHotel</title>

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
            height: 100vh;
        }

        .main::-webkit-scrollbar { width: 4px; }
        .main::-webkit-scrollbar-thumb { background: rgba(255,255,255,.08); border-radius: 20px; }

        .page-header { margin-bottom: 28px; }

        .page-header h1 {
            font-family: 'Cinzel', serif;
            font-size: 40px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 8px;
        }

        .page-header p { color: var(--text-secondary); font-size: 15px; }

        .date-badge {
            display: inline-block;
            background: rgba(212,175,55,.1);
            border: 1px solid rgba(212,175,55,.2);
            color: var(--gold-light);
            padding: 6px 16px;
            border-radius: 999px;
            font-size: 13px;
            margin-top: 8px;
        }

        /* GRID */
        .desk-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .glass {
            background: var(--surface);
            border: 1px solid var(--border);
            backdrop-filter: blur(14px);
            border-radius: 24px;
            overflow: hidden;
        }

        .full-width { grid-column: 1 / -1; }

        /* PANEL */
        .panel-header {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255,255,255,.05);
            background: linear-gradient(90deg, rgba(212,175,55,.07), transparent);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .panel-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            background: rgba(212,175,55,.12);
            border: 1px solid rgba(212,175,55,.2);
            flex-shrink: 0;
        }

        .panel-header-text h3 {
            font-size: 15px;
            font-weight: 600;
            color: white;
            margin-bottom: 2px;
        }

        .panel-header-text p {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .panel-body {
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* FORM */
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

        .form-group { display: flex; flex-direction: column; gap: 7px; }
        .form-group.full { grid-column: 1 / -1; }

        .form-label {
            font-size: 11px;
            color: var(--text-secondary);
            font-weight: 600;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .form-input, .form-textarea {
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

        .form-input:focus, .form-textarea:focus { border-color: rgba(212,175,55,.4); }
        .form-input::placeholder, .form-textarea::placeholder { color: #7f93b0; }

        .form-textarea { resize: vertical; min-height: 90px; line-height: 1.6; }

        /* BUTTONS */
        .btn-gold {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #c99a2e, #d4af37);
            color: #041026;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: .25s;
        }

        .btn-gold:hover { filter: brightness(1.08); transform: translateY(-1px); }
        .btn-gold:disabled { opacity: .6; cursor: not-allowed; transform: none; }

        .btn-outline {
            width: 100%;
            padding: 13px;
            background: rgba(212,175,55,.08);
            color: var(--gold-light);
            border: 1px solid rgba(212,175,55,.25);
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: .25s;
        }

        .btn-outline:hover { background: rgba(212,175,55,.15); }
        .btn-outline:disabled { opacity: .6; cursor: not-allowed; }

        /* RESULT */
        .result-box {
            display: none;
            background: linear-gradient(135deg, rgba(212,175,55,.08), rgba(255,255,255,.03));
            border: 1px solid rgba(212,175,55,.15);
            border-radius: 16px;
            padding: 18px;
            font-size: 14px;
            line-height: 1.8;
            color: #e2e8f0;
        }

        .result-box.show { display: block; }

        .result-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* LOADING */
        .loading-bar { display: none; height: 2px; background: rgba(255,255,255,.06); border-radius: 2px; overflow: hidden; }
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

        /* CHECKLIST */
        .checklist-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }

        .check-section h4 {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 14px;
        }

        .check-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,.04);
            cursor: pointer;
            transition: .15s;
        }

        .check-item:last-of-type { border-bottom: none; }
        .check-item:hover { opacity: .85; }

        .check-box {
            width: 18px;
            height: 18px;
            border: 1.5px solid rgba(255,255,255,.2);
            border-radius: 5px;
            flex-shrink: 0;
            margin-top: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .2s;
        }

        .check-item.done .check-box {
            background: var(--gold);
            border-color: var(--gold);
        }

        .check-item.done .check-box::after {
            content: '✓';
            font-size: 11px;
            font-weight: 700;
            color: #041026;
        }

        .check-text { font-size: 13px; color: #c8d8e8; line-height: 1.4; }
        .check-item.done .check-text { text-decoration: line-through; color: rgba(255,255,255,.3); }

        .progress-wrap { margin-top: 12px; }

        .progress-bar {
            height: 3px;
            background: rgba(255,255,255,.08);
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #c99a2e, #d4af37);
            border-radius: 3px;
            transition: width .3s ease;
        }

        .progress-text {
            font-size: 11px;
            color: var(--text-secondary);
            margin-top: 6px;
            text-align: right;
        }

        @media (max-width: 1100px) { .desk-grid { grid-template-columns: 1fr; } }

        @media (max-width: 768px) {
            .main { margin-left: 0; padding: 18px; }
            .page-header h1 { font-size: 30px; }
            .form-row { grid-template-columns: 1fr; }
            .checklist-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>

@include('layouts.sidebar-management')

<div class="main">

    <div class="page-header">
        <h1>Asisten Resepsionis</h1>
        <p>Panel AI untuk membantu pelayanan front desk harian</p>
        <span class="date-badge">
            <i class="fas fa-calendar-day"></i>
            {{ now()->translatedFormat('l, d F Y') }}
        </span>
    </div>

    <div class="desk-grid">

        {{-- ── CARI KAMAR WALK-IN ── --}}
        <div class="glass">
            <div class="panel-header">
                <div class="panel-icon">🛏️</div>
                <div class="panel-header-text">
                    <h3>Cari Kamar Walk-in</h3>
                    <p>AI pilihkan kamar paling sesuai untuk tamu</p>
                </div>
            </div>
            <div class="panel-body">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Jumlah Tamu</label>
                        <input type="number" class="form-input" id="wJumlah" min="1" value="1" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Check-in</label>
                        <input type="date" class="form-input" id="wCheckin" value="{{ now()->format('Y-m-d') }}" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Check-out</label>
                        <input type="date" class="form-input" id="wCheckout" value="{{ now()->addDay()->format('Y-m-d') }}" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kebutuhan Khusus</label>
                        <input type="text" class="form-input" id="wKebutuhan" placeholder="cth: extra bed, quiet room" />
                    </div>
                </div>

                <div class="loading-bar" id="loadingCari"></div>

                <button class="btn-gold" id="btnCari" onclick="cariKamar()">
                    <i class="fas fa-magnifying-glass"></i> Tanyakan AI
                </button>

                <div class="result-box" id="hasilCari">
                    <div class="result-label"><i class="fas fa-robot"></i> Saran AI</div>
                    <div id="hasilCariText"></div>
                </div>
            </div>
        </div>

        {{-- ── TANGANI KOMPLAIN ── --}}
        <div class="glass">
            <div class="panel-header">
                <div class="panel-icon">💬</div>
                <div class="panel-header-text">
                    <h3>Tangani Komplain Tamu</h3>
                    <p>Dapatkan saran penanganan profesional dari AI</p>
                </div>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="form-label">Nama Tamu (Opsional)</label>
                    <input type="text" class="form-input" id="kNama" placeholder="Nama tamu" />
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi Komplain</label>
                    <textarea class="form-textarea" id="kKomplain"
                        placeholder="Jelaskan komplain tamu secara singkat..."></textarea>
                </div>

                <div class="loading-bar" id="loadingKomplain"></div>

                <button class="btn-outline" id="btnKomplain" onclick="tanganiKomplain()">
                    <i class="fas fa-wand-magic-sparkles"></i> Minta Saran AI
                </button>

                <div class="result-box" id="hasilKomplain">
                    <div class="result-label"><i class="fas fa-list-check"></i> Langkah Penanganan</div>
                    <div id="hasilKomplainText"></div>
                </div>
            </div>
        </div>

        {{-- ── CHECKLIST HARIAN ── --}}
        <div class="glass full-width">
            <div class="panel-header">
                <div class="panel-icon">📋</div>
                <div class="panel-header-text">
                    <h3>Checklist Prosedur Harian</h3>
                    <p>Pantau progres check-in & check-out hari ini</p>
                </div>
            </div>
            <div class="panel-body">
                <div class="checklist-grid">

                    <div class="check-section" id="sectionCheckin">
                        <h4><i class="fas fa-arrow-right-to-bracket"></i> Check-in</h4>
                        @foreach([
                            'Verifikasi identitas tamu (KTP/Paspor)',
                            'Konfirmasi reservasi di sistem',
                            'Proses pembayaran atau deposit',
                            'Berikan kunci & informasi kamar',
                            'Jelaskan fasilitas & jam breakfast',
                            'Catat permintaan khusus tamu',
                        ] as $item)
                        <div class="check-item" onclick="toggleCheck(this, 'checkin')">
                            <div class="check-box"></div>
                            <span class="check-text">{{ $item }}</span>
                        </div>
                        @endforeach
                        <div class="progress-wrap">
                            <div class="progress-bar">
                                <div class="progress-fill" id="fillCheckin" style="width:0%"></div>
                            </div>
                            <div class="progress-text" id="textCheckin">0 / 6 selesai</div>
                        </div>
                    </div>

                    <div class="check-section" id="sectionCheckout">
                        <h4><i class="fas fa-arrow-right-from-bracket"></i> Check-out</h4>
                        @foreach([
                            'Konfirmasi tanggal & waktu check-out',
                            'Periksa tagihan tambahan (minibar, laundry)',
                            'Proses pembayaran final',
                            'Minta pengembalian kunci kamar',
                            'Catat kondisi kamar untuk housekeeping',
                            'Sampaikan feedback & survey kepuasan',
                        ] as $item)
                        <div class="check-item" onclick="toggleCheck(this, 'checkout')">
                            <div class="check-box"></div>
                            <span class="check-text">{{ $item }}</span>
                        </div>
                        @endforeach
                        <div class="progress-wrap">
                            <div class="progress-bar">
                                <div class="progress-fill" id="fillCheckout" style="width:0%"></div>
                            </div>
                            <div class="progress-text" id="textCheckout">0 / 6 selesai</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

// ── CARI KAMAR ──
async function cariKamar() {
    const btn = document.getElementById('btnCari');
    const loading = document.getElementById('loadingCari');
    const result = document.getElementById('hasilCari');
    const resultText = document.getElementById('hasilCariText');

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mencari...';
    loading.classList.add('show');
    result.classList.remove('show');

    try {
        const res = await fetch('{{ route("ai.resepsionis.cari") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({
                jumlah_tamu: document.getElementById('wJumlah').value,
                check_in:    document.getElementById('wCheckin').value,
                check_out:   document.getElementById('wCheckout').value,
                kebutuhan:   document.getElementById('wKebutuhan').value,
            })
        });
        const data = await res.json();
        resultText.innerHTML = (data.saran ?? 'Tidak ada saran.').replace(/\n/g, '<br>');
        result.classList.add('show');
    } catch {
        resultText.innerHTML = 'Gagal terhubung ke AI. Coba lagi.';
        result.classList.add('show');
    } finally {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-magnifying-glass"></i> Tanyakan AI';
        loading.classList.remove('show');
    }
}

// ── TANGANI KOMPLAIN ──
async function tanganiKomplain() {
    const komplain = document.getElementById('kKomplain').value.trim();
    if (!komplain) { alert('Isi deskripsi komplain terlebih dahulu.'); return; }

    const btn = document.getElementById('btnKomplain');
    const loading = document.getElementById('loadingKomplain');
    const result = document.getElementById('hasilKomplain');
    const resultText = document.getElementById('hasilKomplainText');

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
    loading.classList.add('show');
    result.classList.remove('show');

    try {
        const res = await fetch('{{ route("ai.resepsionis.komplain") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ komplain })
        });
        const data = await res.json();
        resultText.innerHTML = (data.saran ?? 'Tidak ada saran.').replace(/\n/g, '<br>');
        result.classList.add('show');
    } catch {
        resultText.innerHTML = 'Gagal terhubung ke AI. Coba lagi.';
        result.classList.add('show');
    } finally {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-wand-magic-sparkles"></i> Minta Saran AI';
        loading.classList.remove('show');
    }
}

// ── CHECKLIST ──
const counters = { checkin: 0, checkout: 0 };
const totals   = { checkin: 6, checkout: 6 };

function toggleCheck(el, type) {
    el.classList.toggle('done');
    counters[type] = document.querySelectorAll(`#section${type.charAt(0).toUpperCase() + type.slice(1)} .check-item.done`).length;
    const pct = Math.round((counters[type] / totals[type]) * 100);
    document.getElementById(`fill${type.charAt(0).toUpperCase() + type.slice(1)}`).style.width = pct + '%';
    document.getElementById(`text${type.charAt(0).toUpperCase() + type.slice(1)}`).textContent = `${counters[type]} / ${totals[type]} selesai`;
}
</script>

</body>
</html>