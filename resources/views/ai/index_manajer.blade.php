<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AI Insight Manajemen - AnoHotel</title>

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

        /* HEADER */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-header h1 {
            font-family: 'Cinzel', serif;
            font-size: 38px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 8px;
        }

        .page-header p { color: var(--text-secondary); font-size: 15px; }

        .periode-tabs { display: flex; gap: 8px; flex-wrap: wrap; }

        .tab-btn {
            padding: 9px 20px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,.08);
            background: rgba(255,255,255,.03);
            color: var(--text-secondary);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px;
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

        /* METRIC CARDS */
        .metrics-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }

        .metric-card {
            background: var(--surface);
            border: 1px solid var(--border);
            backdrop-filter: blur(14px);
            border-radius: 20px;
            padding: 20px 22px;
            position: relative;
            overflow: hidden;
            transition: transform .2s;
        }

        .metric-card:hover { transform: translateY(-2px); }

        .metric-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
        }

        .metric-card.blue::before   { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
        .metric-card.green::before  { background: linear-gradient(90deg, #22c55e, #4ade80); }
        .metric-card.gold::before   { background: linear-gradient(90deg, #c99a2e, #d4af37); }
        .metric-card.purple::before { background: linear-gradient(90deg, #a855f7, #c084fc); }

        .metric-icon {
            font-size: 20px;
            margin-bottom: 12px;
            opacity: .8;
        }

        .metric-label {
            font-size: 11px;
            color: var(--text-secondary);
            font-weight: 600;
            letter-spacing: .05em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .metric-value {
            font-size: 28px;
            font-weight: 300;
            color: white;
            line-height: 1;
            margin-bottom: 4px;
        }

        .metric-value sup {
            font-size: 13px;
            font-weight: 400;
            color: var(--text-secondary);
        }

        .metric-sub { font-size: 12px; color: rgba(255,255,255,.3); }

        /* MAIN GRID */
        .main-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .full-width { grid-column: 1 / -1; }

        .glass {
            background: var(--surface);
            border: 1px solid var(--border);
            backdrop-filter: blur(14px);
            border-radius: 24px;
            overflow: hidden;
        }

        .panel-header {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255,255,255,.05);
            background: linear-gradient(90deg, rgba(212,175,55,.07), transparent);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .panel-header-left { display: flex; align-items: center; gap: 12px; }

        .panel-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            background: rgba(212,175,55,.1);
            border: 1px solid rgba(212,175,55,.2);
            flex-shrink: 0;
        }

        .panel-header-text h3 { font-size: 15px; font-weight: 600; color: white; margin-bottom: 2px; }
        .panel-header-text p { font-size: 12px; color: var(--text-secondary); }

        .btn-refresh {
            padding: 8px 18px;
            border-radius: 999px;
            border: 1px solid rgba(212,175,55,.25);
            background: rgba(212,175,55,.08);
            color: var(--gold-light);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
            white-space: nowrap;
        }

        .btn-refresh:hover { background: rgba(212,175,55,.15); }
        .btn-refresh:disabled { opacity: .5; cursor: not-allowed; }

        .panel-body {
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* INSIGHT */
        .insight-empty {
            text-align: center;
            padding: 40px 20px;
            color: rgba(255,255,255,.2);
        }

        .insight-empty i { font-size: 2.5rem; margin-bottom: 12px; display: block; }
        .insight-empty p { font-size: 13px; line-height: 1.6; }

        .insight-content {
            display: none;
            font-size: 14px;
            line-height: 1.9;
            color: #c8d8e8;
        }

        .insight-content.show { display: block; }

        /* LAPORAN */
        .form-group { display: flex; flex-direction: column; gap: 7px; }

        .form-label {
            font-size: 11px;
            color: var(--text-secondary);
            font-weight: 600;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .form-select {
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

        .form-select:focus { border-color: rgba(212,175,55,.4); }
        .form-select option { background: #08172f; }

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

        /* AKTIVITAS */
        .activity-list { display: flex; flex-direction: column; }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255,255,255,.04);
        }

        .activity-item:last-child { border-bottom: none; }

        .activity-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .activity-text { flex: 1; font-size: 13px; color: #90a0b7; }
        .activity-text strong { color: #c8d8e8; font-weight: 500; }
        .activity-time { font-size: 11px; color: rgba(255,255,255,.2); flex-shrink: 0; }

        .empty-activity {
            text-align: center;
            padding: 30px;
            color: rgba(255,255,255,.2);
            font-size: 13px;
        }

        @media (max-width: 1200px) { .metrics-row { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 1100px) { .main-grid { grid-template-columns: 1fr; } }
        @media (max-width: 768px) {
            .main { margin-left: 0; padding: 18px; }
            .page-header h1 { font-size: 28px; }
            .metrics-row { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>

<body>

@include('layouts.sidebar-management')

<div class="main">

    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h1>AI Insight Manajemen</h1>
            <p>Analisis operasional & laporan hotel berbasis data real-time</p>
        </div>
        <div class="periode-tabs">
            <button class="tab-btn active" onclick="setPeriode('hari_ini', this)">Hari ini</button>
            <button class="tab-btn" onclick="setPeriode('minggu_ini', this)">Minggu ini</button>
            <button class="tab-btn" onclick="setPeriode('bulan_ini', this)">Bulan ini</button>
        </div>
    </div>

    {{-- METRIC CARDS --}}
    <div class="metrics-row">
        <div class="metric-card blue">
            <div class="metric-icon">🏨</div>
            <div class="metric-label">Okupansi</div>
            <div class="metric-value" id="mOkupansi">–<sup>%</sup></div>
            <div class="metric-sub" id="mOkupansiSub">Memuat...</div>
        </div>
        <div class="metric-card green">
            <div class="metric-icon">🛎️</div>
            <div class="metric-label">Check-in Hari Ini</div>
            <div class="metric-value" id="mCheckin">–</div>
            <div class="metric-sub" id="mCheckinSub">– check-out</div>
        </div>
        <div class="metric-card gold">
            <div class="metric-icon">⏳</div>
            <div class="metric-label">Reservasi Pending</div>
            <div class="metric-value" id="mPending">–</div>
            <div class="metric-sub">Perlu konfirmasi</div>
        </div>
        <div class="metric-card purple">
            <div class="metric-icon">💰</div>
            <div class="metric-label">Pendapatan Bulan Ini</div>
            <div class="metric-value" id="mPendapatan" style="font-size:18px;">–</div>
            <div class="metric-sub">Total terkonfirmasi</div>
        </div>
    </div>

    {{-- MAIN GRID --}}
    <div class="main-grid">

        {{-- AI INSIGHT --}}
        <div class="glass">
            <div class="panel-header">
                <div class="panel-header-left">
                    <div class="panel-icon">🤖</div>
                    <div class="panel-header-text">
                        <h3>Analisis AI</h3>
                        <p>Insight kondisi hotel & saran tindakan</p>
                    </div>
                </div>
                <button class="btn-refresh" id="btnInsight" onclick="getInsight()">
                    <i class="fas fa-rotate-right"></i> Refresh
                </button>
            </div>
            <div class="panel-body">
                <div class="loading-bar" id="loadingInsight"></div>

                <div class="insight-empty" id="insightEmpty">
                    <i class="fas fa-robot"></i>
                    <p>Klik <strong>Refresh</strong> untuk mendapatkan<br>analisis kondisi hotel saat ini</p>
                </div>

                <div class="insight-content" id="insightContent"></div>
            </div>
        </div>

        {{-- LAPORAN RINGKAS --}}
        <div class="glass">
            <div class="panel-header">
                <div class="panel-header-left">
                    <div class="panel-icon">📊</div>
                    <div class="panel-header-text">
                        <h3>Laporan Ringkas</h3>
                        <p>Ringkasan keuangan & performa hotel</p>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="form-label">Pilih Periode</label>
                    <select class="form-select" id="periodeLaporan">
                        <option value="hari_ini">Hari ini</option>
                        <option value="minggu_ini">Minggu ini</option>
                        <option value="bulan_ini">Bulan ini</option>
                    </select>
                </div>

                <div class="loading-bar" id="loadingLaporan"></div>

                <button class="btn-gold" id="btnLaporan" onclick="getLaporan()">
                    <i class="fas fa-file-chart-column"></i> Generate Laporan AI
                </button>

                <div class="result-box" id="laporanResult"></div>
            </div>
        </div>

        {{-- AKTIVITAS TERBARU --}}
        <div class="glass full-width">
            <div class="panel-header">
                <div class="panel-header-left">
                    <div class="panel-icon">📋</div>
                    <div class="panel-header-text">
                        <h3>Aktivitas Terbaru</h3>
                        <p>Log transaksi & perubahan status hari ini</p>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="activity-list">
                    @forelse($aktivitas ?? [] as $log)
                    <div class="activity-item">
                        <div class="activity-dot" style="background:
                            {{ $log->type === 'checkin'  ? '#22c55e' :
                               ($log->type === 'checkout' ? '#3b82f6' :
                               ($log->type === 'payment'  ? '#d4af37' : '#90a0b7')) }}">
                        </div>
                        <div class="activity-text">{!! $log->description !!}</div>
                        <div class="activity-time">{{ $log->created_at->diffForHumans() }}</div>
                    </div>
                    @empty
                    <div class="empty-activity">
                        <i class="fas fa-clock" style="margin-right:6px;"></i>
                        Belum ada aktivitas tercatat hari ini
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;
let currentPeriode = 'hari_ini';

function setPeriode(p, btn) {
    currentPeriode = p;
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}

function formatRupiah(num) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency', currency: 'IDR', maximumFractionDigits: 0
    }).format(num);
}

// ── GET INSIGHT ──
async function getInsight() {
    const btn     = document.getElementById('btnInsight');
    const loading = document.getElementById('loadingInsight');
    const content = document.getElementById('insightContent');
    const empty   = document.getElementById('insightEmpty');

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    loading.classList.add('show');
    empty.style.display = 'none';
    content.classList.remove('show');

    try {
        const res = await fetch('{{ route("ai.manajer.insight") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ periode: currentPeriode })
        });
        const data = await res.json();

        content.innerHTML = (data.insight ?? 'Tidak ada insight.').replace(/\n/g, '<br>');
        content.classList.add('show');

        // Update metric cards
        if (data.metrics) {
            const m = data.metrics;
            document.getElementById('mOkupansi').innerHTML    = `${m.okupansi ?? '–'}<sup>%</sup>`;
            document.getElementById('mOkupansiSub').textContent = `${m.terisi ?? '–'} / ${m.total ?? '–'} kamar`;
            document.getElementById('mCheckin').textContent    = m.checkin ?? '–';
            document.getElementById('mCheckinSub').textContent = `${m.checkout ?? '–'} check-out`;
            document.getElementById('mPending').textContent    = m.pending ?? '–';
            document.getElementById('mPendapatan').textContent = m.pendapatan ? formatRupiah(m.pendapatan) : '–';
        }

    } catch {
        content.innerHTML = 'Gagal terhubung ke AI. Coba lagi.';
        content.classList.add('show');
    } finally {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-rotate-right"></i> Refresh';
        loading.classList.remove('show');
    }
}

// ── GET LAPORAN ──
async function getLaporan() {
    const periode = document.getElementById('periodeLaporan').value;
    const btn     = document.getElementById('btnLaporan');
    const loading = document.getElementById('loadingLaporan');
    const result  = document.getElementById('laporanResult');

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Membuat laporan...';
    loading.classList.add('show');
    result.classList.remove('show');

    try {
        const res = await fetch('{{ route("ai.manajer.laporan") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ periode })
        });
        const data = await res.json();
        result.innerHTML = (data.laporan ?? 'Tidak ada laporan.').replace(/\n/g, '<br>');
        result.classList.add('show');
    } catch {
        result.innerHTML = 'Gagal generate laporan. Coba lagi.';
        result.classList.add('show');
    } finally {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-file-chart-column"></i> Generate Laporan AI';
        loading.classList.remove('show');
    }
}

// ── INIT PADA SAAT HALAMAN DIMUAT ──
document.addEventListener('DOMContentLoaded', () => {
    // Memuat metrik awal secara otomatis tanpa harus klik Refresh
    getInsight();
});
</script>

</body>
</html>