<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { margin:0; padding:0; box-sizing:border-box; }

        :root {
            --gold:#d4af37;
            --gold-light:#f3e5ab;
            --gold-dim:rgba(212,175,55,.08);
            --gold-border:rgba(212,175,55,.18);
            --bg:#041026;
            --surface:rgba(255,255,255,.04);
            --border:rgba(255,255,255,.08);
            --muted:#90a0b7;
            --success:#10b981;
            --warning:#f59e0b;
            --danger:#ef4444;
        }

        body {
            min-height:100vh;
            background:linear-gradient(135deg,#041026 0%,#08172f 50%,#0d2347 100%);
            color:white;
            font-family:'Plus Jakarta Sans',sans-serif;
            overflow-x:hidden;
        }

        .main {
            margin-left:260px;
            width:calc(100% - 260px);
            min-height:100vh;
            padding:2rem;
        }

        .hero {
            position:relative;
            min-height:230px;
            border-radius:24px;
            overflow:hidden;
            border:1px solid var(--gold-border);
            background:#030d20;
            padding:2.5rem;
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
            box-shadow:0 14px 40px rgba(0,0,0,.25);
            margin-bottom:1.5rem;
        }

        .hero-bg {
            position:absolute;
            inset:0;
            background-image:url('{{ asset('images/Payments.png') }}');
            background-size:cover;
            background-position:center;
            opacity:.55;
            transform:scale(1.03);
        }

        .hero-overlay {
            position:absolute;
            inset:0;
            background:linear-gradient(90deg,rgba(4,16,38,.94),rgba(4,16,38,.62),rgba(4,16,38,.35));
        }

        .hero-content,
        .hero-action {
            position:relative;
            z-index:2;
        }

        .eyebrow {
            color:var(--gold);
            text-transform:uppercase;
            letter-spacing:.25em;
            font-size:.72rem;
            font-weight:800;
            margin-bottom:.9rem;
        }

        .hero h1 {
            font-family:'Cinzel',serif;
            font-size:2.7rem;
            font-weight:700;
            margin-bottom:.5rem;
        }

        .hero p {
            color:#c8d3e6;
        }

        .btn-gold {
            border:none;
            background:linear-gradient(135deg,var(--gold-light),var(--gold));
            color:#041026;
            padding:.9rem 1.4rem;
            border-radius:999px;
            font-weight:800;
            cursor:pointer;
            display:inline-flex;
            align-items:center;
            gap:.55rem;
        }

        .stats-grid {
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:1rem;
            margin-top:-4rem;
            position:relative;
            z-index:4;
            margin-bottom:1.5rem;
        }

        .stat-card {
            background:rgba(10,18,32,.82);
            border:1px solid var(--border);
            backdrop-filter:blur(18px);
            border-radius:18px;
            padding:1.3rem;
            display:flex;
            align-items:center;
            gap:1rem;
        }

        .stat-icon {
            width:48px;
            height:48px;
            border-radius:14px;
            background:rgba(255,255,255,.05);
            border:1px solid var(--border);
            display:grid;
            place-items:center;
            color:var(--gold);
        }

        .stat-value {
            font-size:1.5rem;
            font-weight:900;
        }

        .stat-label {
            color:var(--muted);
            font-size:.78rem;
            margin-top:.25rem;
        }

        .panel {
            position:relative;
            z-index:10;
            background:rgba(5,12,24,.82);
            border:1px solid var(--border);
            backdrop-filter:blur(18px);
            border-radius:22px;
            overflow:hidden;
            box-shadow:0 18px 38px rgba(0,0,0,.25);
        }

        .panel-header {
            padding:1.5rem;
            border-bottom:1px solid rgba(255,255,255,.06);
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .panel-header h2 {
            font-family:'Cinzel',serif;
            font-size:1.25rem;
        }

        .panel-header p {
            color:var(--muted);
            font-size:.82rem;
            margin-top:.25rem;
        }

        table {
            width:100%;
            border-collapse:collapse;
        }

        thead {
            background:rgba(255,255,255,.055);
        }

        th {
            text-align:left;
            padding:1rem 1.5rem;
            color:#cbd5e1;
            font-size:.75rem;
            text-transform:uppercase;
            letter-spacing:.08em;
        }

        td {
            padding:1.1rem 1.5rem;
            border-top:1px solid rgba(255,255,255,.06);
            color:#f8fafc;
            font-size:.88rem;
        }

        .amount {
            color:var(--gold-light);
            font-weight:900;
        }

        .badge {
            display:inline-flex;
            padding:.45rem .8rem;
            border-radius:999px;
            font-size:.75rem;
            font-weight:900;
            text-transform:capitalize;
        }

        .paid {
    background: rgba(16,185,129,.13);
    color: #34d399;
}


        .unpaid {
    background: rgba(245,158,11,.13);
    color: #fbbf24;
}

        .failed, .cancelled {
            background:rgba(239,68,68,.13);
            color:#f87171;
        }

        .actions {
            display:flex;
            gap:.6rem;
            position:relative;
            z-index:20;
        }

        .btn-action {
            border:1px solid var(--border);
            background:rgba(255,255,255,.05);
            color:white;
            padding:.65rem 1rem;
            border-radius:10px;
            font-weight:800;
            cursor:pointer;
            text-decoration:none;
        }

        .btn-edit {
            color:var(--gold-light);
            border-color:rgba(212,175,55,.25);
        }

        .btn-delete {
            color:#f87171;
            border-color:rgba(239,68,68,.25);
        }

        .modal-overlay {
            position:fixed;
            inset:0;
            z-index:99999;
            background:rgba(0,0,0,.78);
            backdrop-filter:blur(12px);
            display:none;
            align-items:center;
            justify-content:center;
            padding:2rem;
        }

        .modal-overlay.show {
            display:flex;
        }

        .payment-modal {
            width:100%;
            max-width:880px;
            background:#111827;
            border:1px solid rgba(255,255,255,.12);
            border-radius:30px;
            overflow:hidden;
            box-shadow:0 30px 90px rgba(0,0,0,.6);
        }

        .modal-head {
            padding:2rem 2.5rem;
            border-bottom:1px solid rgba(255,255,255,.08);
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
        }

        .modal-head h2 {
            font-size:2.3rem;
            font-weight:900;
        }

        .modal-head p {
            color:#94a3b8;
            margin-top:.5rem;
        }

        .modal-close {
            width:52px;
            height:52px;
            border-radius:16px;
            border:1px solid rgba(255,255,255,.08);
            background:rgba(255,255,255,.06);
            color:#cbd5e1;
            cursor:pointer;
        }

        .modal-body {
            padding:2.5rem;
        }

        .modal-grid {
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:1.2rem;
        }

        .modal-group {
            margin-bottom:1.4rem;
        }

        .modal-group.full {
            grid-column:span 2;
        }

        .modal-group label {
            display:block;
            margin-bottom:.6rem;
            color:#cbd5e1;
            font-weight:800;
        }

        .modal-group input,
        .modal-group select {
            width:100%;
            height:58px;
            background:#020817;
            border:1px solid rgba(255,255,255,.1);
            border-radius:16px;
            color:white;
            padding:0 1.2rem;
            outline:none;
        }

        .modal-actions {
            display:flex;
            justify-content:flex-end;
            gap:1rem;
            margin-top:.5rem;
        }

        .modal-cancel,
        .modal-submit {
            height:54px;
            padding:0 1.8rem;
            border-radius:16px;
            font-weight:900;
            cursor:pointer;
            border:none;
        }

        .modal-cancel {
            background:rgba(255,255,255,.06);
            color:#cbd5e1;
            border:1px solid rgba(255,255,255,.1);
        }

        .modal-submit {
            background:linear-gradient(135deg,#facc15,#d4af37);
            color:#041026;
        }

        @media(max-width:768px) {
            .main {
                margin-left:0;
                width:100%;
                padding:1rem;
            }

            .stats-grid,
            .modal-grid {
                grid-template-columns:1fr;
            }

            .modal-group.full {
                grid-column:span 1;
            }
        }

        .refunded {
    background: rgba(239,68,68,.13);
    color: #f87171;
}
    </style>
</head>

<body>

@include('layouts.sidebar-management')

<main class="main">

    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <div class="eyebrow">Hotel Management</div>
            <h1>Payments</h1>
            <p>Manage reservation payments, billing method, and transaction status.</p>
        </div>

        <div class="hero-action">
            <button type="button" class="btn-gold" id="openCreatePaymentBtn">
                <i class="fas fa-plus"></i>
                Create Payment
            </button>
        </div>
    </section>

    <section class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-wallet"></i></div>
            <div>
                <div class="stat-value">Rp {{ number_format($payments->where('status', 'paid')->sum('amount'), 0, ',', '.') }}</div>
                <div class="stat-label">Total Paid</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-file-invoice"></i></div>
            <div>
                <div class="stat-value">{{ $payments->count() }}</div>
                <div class="stat-label">Transactions</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
            <div>
                <div class="stat-value">{{ $payments->where('status', 'unpaid')->count() }}</div>
                <div class="stat-label">Pending</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-circle-check"></i></div>
            <div>
                <div class="stat-value">{{ $payments->whereIn('status', ['paid', 'success', 'settled'])->count() }}</div>
                <div class="stat-label">Paid</div>
            </div>
        </div>
    </section>

    <section class="panel">
        <div class="panel-header">
            <div>
                <h2>Payment List</h2>
                <p>Latest hotel payment transactions</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>Reservation</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($payments as $payment)
                        <tr>
                            <td>#{{ $payment->reservation_id }}</td>

                            <td class="amount">
                                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                            </td>

                            <td>
                                {{ ucwords(str_replace('_', ' ', $payment->method)) }}
                            </td>

                            <td>
                                <span class="badge {{ strtolower($payment->status) }}">
                                    {{ ucwords(str_replace('_', ' ', $payment->status)) }}
                                </span>
                            </td>

                            <td>
                                <div class="actions">
                                    <button type="button"
                                            class="btn-action btn-edit"
                                            onclick="openEditPaymentModal(
                                                '{{ $payment->id }}',
                                                '{{ $payment->reservation_id }}',
                                                '{{ $payment->amount }}',
                                                '{{ $payment->method }}',
                                                '{{ $payment->status }}'
                                            )">
                                        Edit
                                    </button>

                                    <form action="{{ route('payments.destroy', $payment->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this payment?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-action btn-delete">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center; padding:3rem; color:var(--muted);">
                                No payments found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

</main>

{{-- CREATE MODAL --}}
<div id="createPaymentModal" class="modal-overlay">
    <div class="payment-modal">
        <div class="modal-head">
            <div>
                <h2>Create Payment</h2>
                <p>Add new payment transaction</p>
            </div>

            <button type="button" class="modal-close" onclick="closeCreatePaymentModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form action="{{ route('payments.store') }}" method="POST" class="modal-body">
            @csrf

            <div class="modal-group full">
                <label>Reservation</label>
                <select name="reservation_id" required>
                    <option value="">Select Reservation</option>
                    @foreach($reservations as $reservation)
                        <option value="{{ $reservation->id }}">
                            #RES-{{ str_pad($reservation->id, 4, '0', STR_PAD_LEFT) }}
                            - Room #{{ $reservation->room->room_number ?? '-' }}
                            - {{ $reservation->user->name ?? 'Guest' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="modal-grid">
                <div class="modal-group">
                    <label>Amount</label>
                    <input type="number" step="any" name="amount" min="0" placeholder="Example: 500000" required>
                </div>

                <div class="modal-group">
                    <label>Method</label>
                    <select name="method" required>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                        <option value="card">Card</option>
                    </select>
                </div>
            </div>

            <div class="modal-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="unpaid">Unpaid</option>
                    <option value="paid">Paid</option>
                    <option value="refunded">Refunded</option>
                </select>
            </div>

            <div class="modal-actions">
                <button type="button" class="modal-cancel" onclick="closeCreatePaymentModal()">Cancel</button>
                <button type="submit" class="modal-submit">Save Payment</button>
            </div>
        </form>
    </div>
</div>

{{-- EDIT MODAL --}}
<div id="editPaymentModal" class="modal-overlay">

    <div class="payment-modal">

        <div class="modal-head">

            <div>
                <h2>Edit Payment</h2>
                <p>Update payment transaction</p>
            </div>

            <button type="button"
                    class="modal-close"
                    onclick="closeEditPaymentModal()">

                <i class="fas fa-times"></i>

            </button>

        </div>

        <form id="editPaymentForm"
              method="POST"
              class="modal-body">

            @csrf
            @method('PUT')

            {{-- RESERVATION --}}
            <div class="modal-group full">

                <label>Reservation</label>

                <select id="edit_reservation_id"
                        name="reservation_id"
                        required>

                    @foreach($reservations as $reservation)

                        <option value="{{ $reservation->id }}">

                            #RES-{{ str_pad($reservation->id, 4, '0', STR_PAD_LEFT) }}
                            -
                            Room #{{ $reservation->room->room_number ?? '-' }}
                            -
                            {{ $reservation->user->name ?? 'Guest' }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="modal-grid">

                {{-- AMOUNT --}}
                <div class="modal-group">

                    <label>Amount</label>

                    <input type="number"
                           id="edit_amount"
                           name="amount"
                           step="any"
                           required>

                </div>

                {{-- METHOD --}}
                <div class="modal-group">

                    <label>Method</label>

                    <select id="edit_method"
                            name="method"
                            required>

                        <option value="cash">
                            Cash
                        </option>

                        <option value="transfer">
                            Transfer
                        </option>

                        <option value="card">
                            Card
                        </option>

                    </select>

                </div>

            </div>

            {{-- STATUS --}}
            <div class="modal-group">

                <label>Status</label>

                <select id="edit_status"
                        name="status"
                        required>

                    <option value="unpaid">
                        Unpaid
                    </option>

                    <option value="paid">
                        Paid
                    </option>

                    <option value="refunded">
                        Refunded
                    </option>

                </select>

            </div>

            {{-- BUTTON --}}
            <div class="modal-actions">

                <button type="button"
                        class="modal-cancel"
                        onclick="closeEditPaymentModal()">

                    Cancel

                </button>

                <button type="submit"
                        class="modal-submit">

                    Update Payment

                </button>

            </div>

        </form>

    </div>

</div>

<script>
    const createPaymentModal = document.getElementById('createPaymentModal');
    const editPaymentModal = document.getElementById('editPaymentModal');

    document.getElementById('openCreatePaymentBtn').addEventListener('click', function () {
        createPaymentModal.classList.add('show');
    });

    function closeCreatePaymentModal() {
        createPaymentModal.classList.remove('show');
    }

    function openEditPaymentModal(id, reservationId, amount, method, status) {
        document.getElementById('editPaymentForm').action = `/payments/${id}`;

        document.getElementById('edit_reservation_id').value = reservationId;
        document.getElementById('edit_amount').value = amount;
        document.getElementById('edit_method').value = method;
        document.getElementById('edit_status').value = status;

        editPaymentModal.classList.add('show');
    }

    function closeEditPaymentModal() {
        editPaymentModal.classList.remove('show');
    }
</script>

</body>
</html>