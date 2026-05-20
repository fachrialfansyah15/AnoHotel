{{-- resources/views/rooms/index.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --gold: #d4af37;
            --gold-light: #f3e5ab;
            --gold-dark: #aa8625;
            --gold-dim: rgba(212, 175, 55, 0.08);
            --gold-border: rgba(212, 175, 55, 0.18);

            --bg: #041026;
            --surface: rgba(255, 255, 255, 0.04);
            --surface-dark: rgba(5, 12, 24, 0.82);
            --border-light: rgba(255, 255, 255, 0.08);

            --text-primary: #ffffff;
            --text-secondary: #90a0b7;
            --text-muted: #64748b;

            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;

            --r-sm: 10px;
            --r-md: 14px;
            --r-lg: 22px;
        }

        html {
            background: var(--bg);
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            background: var(--bg);
            color: var(--text-primary);
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            overflow-x: hidden;
        }

        .main {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
            padding: 1.5rem 2rem 2rem 1.5rem;
        }

        .dashboard-container {
            width: 100%;
            max-width: none;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .page-top {
            position: relative;
            min-height: 230px;
            padding: 2.5rem;
            border-radius: var(--r-lg);
            overflow: hidden;
            border: 1px solid var(--gold-border);
            background: #030d20;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            box-shadow: 0 12px 30px rgba(0,0,0,.25);
        }

        .page-bg {
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('images/Rooms.png') }}');
            background-size: cover;
            background-position: center;
            opacity: .58;
        }

        .page-overlay {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(
                    90deg,
                    rgba(4,16,38,.92) 0%,
                    rgba(4,16,38,.68) 48%,
                    rgba(4,16,38,.35) 100%
                );
        }

        .title,
        .top-actions {
            position: relative;
            z-index: 2;
        }

        .title h1 {
            font-size: 2.2rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: .5rem;
        }

        .title p {
            color: #d5dbea;
            font-size: .95rem;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: .8rem;
        }

        .notif-btn,
        .user-pill {
            background: rgba(3,13,32,.65);
            border: 1px solid var(--border-light);
            backdrop-filter: blur(12px);
            border-radius: var(--r-sm);
            color: #fff;
        }

        .notif-btn {
            width: 44px;
            height: 44px;
            display: grid;
            place-items: center;
            color: var(--gold);
            position: relative;
        }

        .notif-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 18px;
            height: 18px;
            background: var(--gold);
            color: #041026;
            font-size: 10px;
            font-weight: 800;
            border-radius: 50%;
            display: grid;
            place-items: center;
        }

        .user-pill {
            height: 44px;
            padding: 0 1rem;
            display: flex;
            align-items: center;
            gap: .65rem;
            font-size: .9rem;
            font-weight: 600;
        }

        .btn-gold {
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: #041026;
            padding: .8rem 1.4rem;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 800;
            font-size: .85rem;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            border: none;
            box-shadow: 0 10px 24px rgba(212,175,55,.25);
            transition: .2s;
        }

        .btn-gold:hover {
            transform: translateY(-1px);
            filter: brightness(1.05);
        }

        .content {
            width: 100%;
            margin-top: -4rem;
            position: relative;
            z-index: 3;
        }

        .rooms-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .mini-stat-card {
            background: rgba(10, 18, 32, .78);
            backdrop-filter: blur(18px);
            border: 1px solid var(--border-light);
            border-radius: var(--r-md);
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            min-height: 108px;
            box-shadow: 0 12px 28px rgba(0,0,0,.22);
        }

        .ms-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: rgba(255,255,255,.05);
            border: 1px solid var(--border-light);
            display: grid;
            place-items: center;
            color: var(--gold);
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .ms-info h4 {
            font-size: 1.6rem;
            font-weight: 800;
            color: #fff;
            line-height: 1;
            margin-bottom: .35rem;
        }

        .ms-info p {
            color: #dbe3ee;
            font-size: .85rem;
            font-weight: 600;
        }

        .ms-info span {
            display: block;
            color: var(--text-secondary);
            font-size: .75rem;
            margin-top: .25rem;
        }

        .controls-bar {
            display: grid;
            grid-template-columns: 1.2fr .7fr .7fr .8fr auto;
            gap: .85rem;
            margin-bottom: 1rem;
        }

        .search-wrapper {
            position: relative;
        }

        .search-wrapper input,
        .filter-select,
        .view-toggle-btn {
            width: 100%;
            height: 46px;
            background: rgba(10, 18, 32, .82);
            border: 1px solid var(--border-light);
            backdrop-filter: blur(16px);
            border-radius: var(--r-sm);
            color: #fff;
            outline: none;
        }

        .search-wrapper input {
            padding: 0 2.8rem 0 1.1rem;
            font-size: .9rem;
        }

        .search-wrapper i {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #cbd5e1;
        }

        .filter-select {
            padding: 0 1rem;
            font-size: .85rem;
            color: #dbe3ee;
        }

        .view-toggle-btn {
            width: 48px;
            display: grid;
            place-items: center;
            cursor: pointer;
            color: #dbe3ee;
        }

        .table-card {
            background: rgba(5, 12, 24, .86);
            border: 1px solid var(--border-light);
            backdrop-filter: blur(20px);
            border-radius: var(--r-md);
            overflow: hidden;
            box-shadow: 0 18px 38px rgba(0,0,0,.28);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: rgba(255,255,255,.06);
        }

        th {
            text-align: left;
            padding: 1rem 1.4rem;
            color: #cbd5e1;
            font-size: .78rem;
            font-weight: 700;
        }

        td {
            padding: .85rem 1.4rem;
            border-top: 1px solid rgba(255,255,255,.06);
            color: #f8fafc;
            font-size: .88rem;
            vertical-align: middle;
        }

        .room-img {
            width: 82px;
            height: 52px;
            object-fit: cover;
            border-radius: 7px;
            border: 1px solid rgba(255,255,255,.08);
        }

        .room-number-text {
            font-size: 1.15rem;
            font-weight: 800;
            color: #fff;
        }

        .room-type-text {
            font-weight: 700;
            color: #fff;
        }

        .room-desc {
            color: var(--text-secondary);
            font-size: .75rem;
            margin-top: .2rem;
        }

        .room-price-text {
            color: #fff;
            font-weight: 600;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .45rem .8rem;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 800;
            text-transform: capitalize;
        }

        .badge::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
        }

        .badge.available {
            background: rgba(16,185,129,.13);
            color: #34d399;
        }

        .badge.available::before {
            background: #34d399;
        }

        .badge.occupied {
            background: rgba(245,158,11,.13);
            color: #fbbf24;
        }

        .badge.occupied::before {
            background: #fbbf24;
        }

        .badge.maintenance {
            background: rgba(239,68,68,.13);
            color: #f87171;
        }

        .badge.maintenance::before {
            background: #f87171;
        }

        .action {
            display: flex;
            align-items: center;
            gap: .6rem;
        }

        .btn-action-view,
        .btn-more,
        .btn-action-edit,
        .btn-action-delete {
            background: rgba(255,255,255,.05);
            border: 1px solid var(--border-light);
            color: #fff;
            border-radius: 10px;
            text-decoration: none;
            font-size: .82rem;
            font-weight: 700;
            transition: .2s;
        }

        .btn-action-view,
        .btn-action-edit,
        .btn-action-delete {
            padding: .65rem 1rem;
        }

        .btn-more {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
        }

        .btn-action-view:hover,
        .btn-more:hover {
            border-color: var(--gold-border);
            background: var(--gold-dim);
        }

        .btn-action-edit {
            color: var(--gold-light);
            border-color: rgba(212,175,55,.22);
        }

        .btn-action-delete {
            cursor: pointer;
            color: #fca5a5;
            border-color: rgba(239,68,68,.2);
        }

        .table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: .9rem 1.4rem;
            border-top: 1px solid rgba(255,255,255,.06);
            color: #cbd5e1;
            font-size: .82rem;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .pagination span,
        .pagination i {
            color: #cbd5e1;
        }

        .pagination .active {
            color: var(--gold-light);
            border: 1px solid var(--gold);
            padding: .35rem .65rem;
            border-radius: 8px;
        }

        @media (max-width: 1200px) {
            .rooms-stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .controls-bar {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .main {
                margin-left: 0;
                width: 100%;
                padding: 1rem;
            }

            .page-top {
                min-height: 260px;
                flex-direction: column;
                gap: 1rem;
            }

            .content {
                margin-top: -2rem;
            }

            .rooms-stats-grid,
            .controls-bar {
                grid-template-columns: 1fr;
            }
        }

        /* SIDEBAR - SAME STYLE AS DASHBOARD */

.logo-icon {
    width: 38px;
    height: 38px;
    background: linear-gradient(135deg, var(--gold-dark), var(--gold));
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #041026;
    box-shadow: 0 4px 12px rgba(212, 175, 55, 0.2);
}


/* MANAGEMENT SIDEBAR FIX */
.management-sidebar {
    width: 260px;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    background: #030d20;
    border-right: 1px solid var(--gold-border);
    padding: 2rem 1.5rem;
    display: flex;
    flex-direction: column;
    z-index: 100;
}

.sidebar-logo {
    display: flex;
    align-items: center;
    gap: .85rem;
    margin-bottom: 2rem;
}

.logo-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--gold-dark), var(--gold));
    color: #041026;
    border-radius: 8px;
    display: grid;
    place-items: center;
    box-shadow: 0 4px 14px rgba(212, 175, 55, .22);
}

.logo-name {
    font-family: 'Cinzel', serif;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--gold);
    line-height: 1;
}

.logo-sub {
    color: var(--text-muted);
    font-size: .65rem;
    letter-spacing: .16em;
    text-transform: uppercase;
    margin-top: .25rem;
}

.sidebar-divider {
    height: 1px;
    background: var(--gold-border);
    opacity: .55;
    margin: 1rem .75rem;
}

.sidebar-label {
    color: var(--gold);
    opacity: .75;
    font-size: .65rem;
    font-weight: 700;
    letter-spacing: .2em;
    text-transform: uppercase;
    padding: 0 .75rem;
    margin: 1.2rem 0 .7rem;
}

.sidebar-nav {
    display: flex;
    flex-direction: column;
    gap: .25rem;
}

.sidebar-link {
    display: flex;
    align-items: center;
    gap: .85rem;
    padding: .8rem .9rem;
    border-radius: var(--r-sm);
    text-decoration: none;
    color: var(--text-secondary);
    font-size: .9rem;
    font-weight: 500;
    border: 1px solid transparent;
    transition: .25s;
}

.sidebar-link i {
    width: 18px;
    text-align: center;
    color: var(--text-muted);
}

.sidebar-link:hover {
    background: var(--surface-hover);
    color: #fff;
}

.sidebar-link:hover i {
    color: var(--gold);
}

.sidebar-link.active {
    background: var(--gold-dim);
    color: var(--gold-light);
    border-color: var(--gold-border);
    font-weight: 700;
}

.sidebar-link.active i {
    color: var(--gold);
}

.sidebar-spacer {
    flex: 1;
}

.sidebar-logout {
    display: flex;
    align-items: center;
    gap: .7rem;
    color: var(--text-muted);
    text-decoration: none;
    padding: .75rem .9rem;
    border-radius: var(--r-sm);
    border: 1px solid transparent;
    transition: .25s;
    font-size: .85rem;
}

.sidebar-logout:hover {
    color: #ff8a8a;
    border-color: rgba(239, 68, 68, .2);
    background: rgba(239, 68, 68, .08);
}

.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.65);
    backdrop-filter: blur(10px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    padding: 1rem;
}

.modal-overlay.show {
    display: flex;
}

.modal-card {
    width: 100%;
    max-width: 760px;
    background: #0b1730;
    border: 1px solid rgba(212,175,55,.18);
    border-radius: 24px;
    padding: 1.8rem;
    box-shadow: 0 30px 80px rgba(0,0,0,.45);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.modal-header h2 {
    color: #d4af37;
    font-size: 1.7rem;
    font-weight: 800;
}

.modal-header p {
    color: #90a0b7;
    margin-top: .35rem;
    font-size: .9rem;
}

.modal-close {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,.08);
    background: rgba(255,255,255,.04);
    color: white;
    cursor: pointer;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.form-group.full {
    grid-column: span 2;
}

.form-group label {
    display: block;
    margin-bottom: .5rem;
    color: #dbe3ee;
    font-size: .85rem;
    font-weight: 700;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    background: #071225;
    border: 1px solid rgba(255,255,255,.10);
    border-radius: 14px;
    color: white;
    padding: .9rem 1rem;
    outline: none;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #d4af37;
}

.modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: .8rem;
    margin-top: 1.5rem;
}

.btn-cancel,
.btn-submit {
    border: none;
    border-radius: 14px;
    padding: .85rem 1.3rem;
    font-weight: 800;
    cursor: pointer;
}

.btn-cancel {
    background: rgba(255,255,255,.06);
    color: #cbd5e1;
}

.btn-submit {
    background: linear-gradient(135deg, #f3e5ab, #d4af37);
    color: #041026;
}

@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }

    .form-group.full {
        grid-column: span 1;
    }
}

    </style>


</head>
<body>

@if(auth()->user()->role === 'guest')

    @include('layouts.sidebar-guest')

@else

    @include('layouts.sidebar-management')

@endif


<main class="main">
    <div class="dashboard-container">

        <div class="page-top">
            <div class="page-bg"></div>
            <div class="page-overlay"></div>

            <div class="title">
                <h1>Rooms</h1>
                <p>Manage hotel rooms and availability</p>
            </div>

            <div class="top-actions">
                <div class="notif-btn">
                    <i class="far fa-bell"></i>
                    <div class="notif-badge">3</div>
                </div>

                <div class="user-pill">
                    <i class="fas fa-user-circle"></i>
                    <span>{{ auth()->user()->name }}</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>

                @can('manage-rooms')
                    <button type="button" onclick="openCreateRoomModal()" class="btn-gold">
                        <i class="fas fa-plus"></i>
                        Add New Room
                    <button>
                @endcan
            </div>
        </div>

        <div class="content">

            <div class="rooms-stats-grid">
                <div class="mini-stat-card">
                    <div class="ms-icon">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div class="ms-info">
                        <h4>{{ $rooms->count() }}</h4>
                        <p>Total Rooms</p>
                        <span>All rooms in property</span>
                    </div>
                </div>

                <div class="mini-stat-card">
                    <div class="ms-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="ms-info">
                        <h4>{{ $rooms->where('status', 'available')->count() }}</h4>
                        <p>Available</p>
                        <span>Ready for booking</span>
                    </div>
                </div>

                <div class="mini-stat-card">
                    <div class="ms-icon">
                        <i class="far fa-calendar"></i>
                    </div>
                    <div class="ms-info">
                        <h4>{{ $rooms->where('status', 'occupied')->count() }}</h4>
                        <p>Occupied</p>
                        <span>Currently checked-in</span>
                    </div>
                </div>

                <div class="mini-stat-card">
                    <div class="ms-icon">
                        <i class="fas fa-wrench"></i>
                    </div>
                    <div class="ms-info">
                        <h4>{{ $rooms->where('status', 'maintenance')->count() }}</h4>
                        <p>Maintenance</p>
                        <span>Under maintenance</span>
                    </div>
                </div>
            </div>

            <div class="controls-bar">
                <div class="search-wrapper">
                    <input type="text" placeholder="Search room by number or type...">
                    <i class="fas fa-search"></i>
                </div>

                <select class="filter-select">
                    <option>All Types</option>
                    <option>Standard Room</option>
                    <option>Deluxe Room</option>
                    <option>Suite Room</option>
                </select>

                <select class="filter-select">
                    <option>All Status</option>
                    <option>Available</option>
                    <option>Occupied</option>
                    <option>Maintenance</option>
                </select>

                <select class="filter-select">
                    <option>Sort by: Room Number</option>
                    <option>Sort by: Price</option>
                    <option>Sort by: Capacity</option>
                </select>

                <div class="view-toggle-btn">
                    <i class="fas fa-list"></i>
                </div>
            </div>

            <div class="table-card">
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Room</th>
                            <th>Type</th>
                            <th>Price / Night</th>
                            <th>Capacity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($rooms as $room)
                            <tr>
                                <td>
                                    <img src="{{ asset('images/Rooms.png') }}" class="room-img" alt="Room">
                                </td>

                                <td class="room-number-text">
                                    #{{ $room->room_number }}
                                </td>

                                <td>
                                    <div class="room-type-text">
                                        {{ ucfirst($room->type) }} Room
                                    </div>

                                    <div class="room-desc">
                                        @if($room->type === 'standard')
                                            Cozy and comfortable
                                        @elseif($room->type === 'deluxe')
                                            Spacious and elegant
                                        @elseif($room->type === 'suite')
                                            Luxury with premium view
                                        @else
                                            Premium hotel room
                                        @endif
                                    </div>
                                </td>

                                <td class="room-price-text">
                                    Rp {{ number_format($room->price_per_night, 0, ',', '.') }}
                                </td>

                                <td>
                                    <i class="fas fa-user text-slate-400 mr-1"></i>
                                    {{ $room->capacity }} Person
                                </td>

                                <td>
                                    <span class="badge {{ strtolower($room->status) }}">
                                        {{ ucfirst($room->status) }}
                                    </span>
                                </td>

                                <td>
                                    <div class="action">
                                        <a href="{{ route('rooms.show', $room->id) }}" class="btn-action-view">
                                            View
                                        </a>

                                        @can('manage-rooms')
                                            <button type="button"
        class="btn-action-edit"
        onclick="openEditRoomModal(
            '{{ $room->id }}',
            '{{ $room->room_number }}',
            '{{ $room->type }}',
            '{{ $room->price_per_night }}',
            '{{ $room->capacity }}',
            '{{ $room->status }}',
            `{{ $room->description }}`
        )">
    Edit
</button>
                                        @endcan

                                        @if(auth()->user()->role === 'admin')
                                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Delete this room?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-delete">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif

                                        <a href="#" class="btn-more">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align:center; padding:3rem; color:var(--text-secondary);">
                                    <i class="fas fa-search-minus text-2xl block mb-2 opacity-50"></i>
                                    No rooms found.
                                </td>
                            </tr>
                        @endforelse

                        
                    </tbody>
                </table>

                <div class="table-footer">
                    <div>
                        Showing {{ $rooms->count() }} rooms
                    </div>

                    <div class="pagination">
                        <i class="fas fa-chevron-left"></i>
                        <span class="active">1</span>
                        <span>2</span>
                        <span>3</span>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </div>

        </div>

    </div>
</main>

<div id="createRoomModal" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            <div>
                <h2>Tambah Kamar</h2>
                <p>Tambahkan data kamar baru ke database AnoHotel.</p>
            </div>

            <button type="button" class="modal-close" onclick="closeCreateRoomModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form action="{{ route('rooms.store') }}" method="POST" class="modal-form">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label>Nomor Kamar</label>
                    <input type="text" name="room_number" placeholder="Contoh: 101" required>
                </div>

                <div class="form-group">
                    <label>Tipe Kamar</label>
                    <select name="type" required>
                        <option value="">Pilih tipe kamar</option>
                        <option value="standard">Standard</option>
                        <option value="deluxe">Deluxe</option>
                        <option value="suite">Suite</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Harga per Malam</label>
                    <input type="number" name="price_per_night" placeholder="Contoh: 350000" required>
                </div>

                <div class="form-group">
                    <label>Kapasitas</label>
                    <input type="number" name="capacity" placeholder="Contoh: 2" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="available">Available</option>
                        <option value="occupied">Occupied</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>

                <div class="form-group full">
                    <label>Deskripsi</label>
                    <textarea name="description" rows="4" placeholder="Opsional"></textarea>
                </div>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeCreateRoomModal()">
                    Batal
                </button>

                <button type="submit" class="btn-submit">
                    Simpan Kamar
                </button>
            </div>
        </form>
    </div>
</div>

<div id="editRoomModal" class="modal-overlay">
    <div class="modal-card">

        <div class="modal-header">
            <div>
                <h2>Edit Kamar</h2>
                <p>Perbarui informasi kamar hotel AnoHotel.</p>
            </div>

            <button type="button" class="modal-close" onclick="closeEditRoomModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form id="editRoomForm" method="POST" class="modal-form">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label>Nomor Kamar</label>
                    <input type="text" id="edit_room_number" name="room_number" required>
                </div>

                <div class="form-group">
                    <label>Tipe Kamar</label>
                    <select id="edit_type" name="type" required>
                        <option value="standard">Standard</option>
                        <option value="deluxe">Deluxe</option>
                        <option value="suite">Suite</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Harga per Malam</label>
                    <input type="number" id="edit_price_per_night" name="price_per_night" required>
                </div>

                <div class="form-group">
                    <label>Kapasitas</label>
                    <input type="number" id="edit_capacity" name="capacity" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select id="edit_status" name="status" required>
                        <option value="available">Available</option>
                        <option value="occupied">Occupied</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>

                <div class="form-group full">
                    <label>Deskripsi</label>
                    <textarea id="edit_description" name="description" rows="4"></textarea>
                </div>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeEditRoomModal()">
                    Batal
                </button>

                <button type="submit" class="btn-submit">
                    Update Kamar
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    function openCreateRoomModal() {
        document.getElementById('createRoomModal').classList.add('show');
    }

    function closeCreateRoomModal() {
        document.getElementById('createRoomModal').classList.remove('show');
    }

    function openEditRoomModal(id, roomNumber, type, pricePerNight, capacity, status, description) {
        document.getElementById('editRoomModal').classList.add('show');

        document.getElementById('editRoomForm').action = `/rooms/${id}`;
        document.getElementById('edit_room_number').value = roomNumber;
        document.getElementById('edit_type').value = type;
        document.getElementById('edit_price_per_night').value = pricePerNight;
        document.getElementById('edit_capacity').value = capacity;
        document.getElementById('edit_status').value = status;
        document.getElementById('edit_description').value = description ?? '';
    }

    function closeEditRoomModal() {
        document.getElementById('editRoomModal').classList.remove('show');
    }
</script>

<script>
// Filter Room Logic
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('.search-wrapper input');
    const selects = document.querySelectorAll('.filter-select');
    if (!searchInput || selects.length < 3) return;

    const tbody = document.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    function filterAndSortRooms() {
        const query = searchInput.value.toLowerCase();
        const typeFilter = selects[0].value;
        const statusFilter = selects[1].value;
        const sortFilter = selects[2].value;

        let visibleRows = [];

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            const typeText = row.querySelector('.type-badge') ? row.querySelector('.type-badge').innerText : '';
            const statusText = row.querySelector('.status-pill') ? row.querySelector('.status-pill').innerText : '';

            const matchSearch = text.includes(query);
            const matchType = typeFilter === 'All Types' || typeText.toLowerCase().includes(typeFilter.toLowerCase().replace(' room', ''));
            const matchStatus = statusFilter === 'All Status' || statusText.toLowerCase() === statusFilter.toLowerCase();

            if (matchSearch && matchType && matchStatus) {
                row.style.display = '';
                visibleRows.push(row);
            } else {
                row.style.display = 'none';
            }
        });

        if (sortFilter.includes('Price')) {
            visibleRows.sort((a, b) => {
                const pa = parseInt(a.querySelector('.price').innerText.replace(/\D/g, ''));
                const pb = parseInt(b.querySelector('.price').innerText.replace(/\D/g, ''));
                return pa - pb;
            });
        } else if (sortFilter.includes('Capacity')) {
            visibleRows.sort((a, b) => {
                const ca = parseInt(a.children[4].innerText);
                const cb = parseInt(b.children[4].innerText);
                return ca - cb;
            });
        } else {
            visibleRows.sort((a, b) => {
                const na = parseInt(a.querySelector('strong').innerText.replace(/\D/g, ''));
                const nb = parseInt(b.querySelector('strong').innerText.replace(/\D/g, ''));
                return na - nb;
            });
        }

        visibleRows.forEach(row => tbody.appendChild(row));
    }

    searchInput.addEventListener('input', filterAndSortRooms);
    selects.forEach(s => s.addEventListener('change', filterAndSortRooms));
});
</script>

</body>
</html>