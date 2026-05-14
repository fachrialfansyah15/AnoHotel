<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

// Public
Route::get('/', fn() => redirect()->route('login'));

// Auth (akan diisi Orang 2)
Route::get('/login',    fn() => view('auth.login'))->name('login');
Route::get('/register', fn() => view('auth.register'))->name('register');

// Protected
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // ✅ CRUD User — Admin only
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    // ✅ CRUD Kamar — Admin & Manajer
    Route::middleware('role:admin,manager')->group(function () {
        Route::post('rooms',           [RoomController::class, 'store'])->name('rooms.store');
        Route::put('rooms/{room}',     [RoomController::class, 'update'])->name('rooms.update');
        Route::delete('rooms/{room}',  [RoomController::class, 'destroy'])->name('rooms.destroy');
        Route::get('rooms/create',     [RoomController::class, 'create'])->name('rooms.create');
        Route::get('rooms/{room}/edit',[RoomController::class, 'edit'])->name('rooms.edit');
    });

    // ✅ Update Status Kamar — Admin, Manajer & Housekeeping
    Route::middleware('role:admin,manager,housekeeping')->group(function () {
        Route::patch('rooms/{room}/status', [RoomController::class, 'updateStatus'])->name('rooms.updateStatus');
    });

    // ✅ Lihat Kamar — Semua role
    Route::get('rooms',        [RoomController::class, 'index'])->name('rooms.index');
    Route::get('rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

    // ✅ Kelola Reservasi — Admin, Manajer & Resepsionis
    Route::middleware('role:admin,manager,receptionist')->group(function () {
        Route::put('reservations/{reservation}',    [ReservationController::class, 'update'])->name('reservations.update');
        Route::delete('reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
        Route::get('reservations/{reservation}/edit',[ReservationController::class, 'edit'])->name('reservations.edit');
        Route::get('reservations',                  [ReservationController::class, 'index'])->name('reservations.index');
    });

    // ✅ Buat Reservasi — Admin, Resepsionis & Tamu
    Route::middleware('role:admin,receptionist,guest')->group(function () {
        Route::get('reservations/create',  [ReservationController::class, 'create'])->name('reservations.create');
        Route::post('reservations',        [ReservationController::class, 'store'])->name('reservations.store');
    });

    // ✅ Lihat Reservasi Sendiri — Tamu
    Route::middleware('role:guest')->group(function () {
        Route::get('my-reservations',         [ReservationController::class, 'myReservations'])->name('reservations.my');
        Route::get('my-reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
        Route::get('my-payments',             [PaymentController::class, 'myPayments'])->name('payments.my');
    });

    // ✅ Kelola Pembayaran — Admin, Manajer & Resepsionis
    Route::middleware('role:admin,manager,receptionist')->group(function () {
        Route::resource('payments', PaymentController::class);
    });

    // ✅ Laporan — Admin & Manajer
    Route::middleware('role:admin,manager')->group(function () {
        Route::get('reports', fn() => view('reports.index'))->name('reports.index');
    });

    // ✅ AI — Admin, Manajer, Resepsionis & Tamu (bukan Housekeeping)
    Route::middleware('role:admin,manager,receptionist,guest')->group(function () {
        Route::get('/ai/chat',      fn() => view('ai.chat'))->name('ai.chat');
        Route::get('/ai/recommend', fn() => view('ai.recommend'))->name('ai.recommend');
    });
});