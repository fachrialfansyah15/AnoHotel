<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AI\TamuAIController;
use App\Http\Controllers\AI\ResepsionisAIController;
use App\Http\Controllers\AI\ManajerAIController;

// Public
Route::get('/', fn() => redirect()->route('login'));

// Auth
Route::get('/login',    [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register',[AuthController::class, 'register'])->name('register.post');
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

// Protected
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // ✅ CRUD User — Admin only
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    // ✅ CRUD Kamar — Admin & Manager
    Route::middleware('role:admin,manager')->group(function () {
        Route::post('rooms',            [RoomController::class, 'store'])->name('rooms.store');
        Route::put('rooms/{room}',      [RoomController::class, 'update'])->name('rooms.update');
        Route::delete('rooms/{room}',   [RoomController::class, 'destroy'])->name('rooms.destroy');
        Route::get('rooms/create',      [RoomController::class, 'create'])->name('rooms.create');
        Route::get('rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
        Route::patch('rooms/{room}/status', [RoomController::class, 'updateStatus'])->name('rooms.updateStatus');
    });

    // ✅ Lihat Kamar — Semua role
    Route::get('rooms',        [RoomController::class, 'index'])->name('rooms.index');
    Route::get('rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

    // ✅ Kelola Reservasi — Admin, Manager & Receptionist
    Route::middleware('role:admin,manager,receptionist')->group(function () {
        Route::get('reservations',                          [ReservationController::class, 'index'])->name('reservations.index');
        Route::get('reservations/{reservation}/edit',       [ReservationController::class, 'edit'])->name('reservations.edit');
        Route::put('reservations/{reservation}',            [ReservationController::class, 'update'])->name('reservations.update');
        Route::delete('reservations/{reservation}',         [ReservationController::class, 'destroy'])->name('reservations.destroy');
    });

    // ✅ Buat Reservasi — Admin, Receptionist & Guest
    Route::middleware('role:admin,receptionist,guest')->group(function () {
        Route::get('reservations/create',  [ReservationController::class, 'create'])->name('reservations.create');
        Route::post('reservations',        [ReservationController::class, 'store'])->name('reservations.store');
    });

    // ✅ Lihat Reservasi & Pembayaran Sendiri — Guest
    Route::middleware('role:guest')->group(function () {
        Route::get('my-reservations',                   [ReservationController::class, 'myReservations'])->name('reservations.my');
        Route::get('my-reservations/{reservation}',     [ReservationController::class, 'show'])->name('reservations.show');
        Route::get('my-payments',                       [PaymentController::class, 'myPayments'])->name('payments.my');
    });

    // ✅ Kelola Pembayaran — Admin, Manager & Receptionist
    Route::middleware('role:admin,manager,receptionist')->group(function () {
        Route::resource('payments', PaymentController::class);
    });

    // ✅ Laporan — Admin & Manager
    Route::middleware('role:admin,manager')->group(function () {
        Route::get('reports', fn() => view('reports.index'))->name('reports.index');
    });

    // ✅ AI Guest
    Route::middleware('role:guest')->prefix('ai')->group(function () {
        Route::get('/tamu',              [TamuAIController::class, 'index'])->name('ai.tamu.index');
        Route::post('/tamu/chat',        [TamuAIController::class, 'chat'])->name('ai.tamu.chat');
        Route::post('/tamu/rekomendasi', [TamuAIController::class, 'rekomendasi'])->name('ai.tamu.rekomendasi');
    });

    // ✅ AI Receptionist
    Route::middleware('role:receptionist')->prefix('ai')->group(function () {
        Route::get('/resepsionis',                   [ResepsionisAIController::class, 'index'])->name('ai.resepsionis.index');
        Route::post('/resepsionis/cari-kamar',       [ResepsionisAIController::class, 'cariKamar'])->name('ai.resepsionis.cari');
        Route::post('/resepsionis/tangani-komplain', [ResepsionisAIController::class, 'tanganiKomplain'])->name('ai.resepsionis.komplain');
    });

    // ✅ AI Admin & Manager
    Route::middleware('role:admin,manager')->prefix('ai')->group(function () {
        Route::get('/manajer',          [ManajerAIController::class, 'index'])->name('ai.manajer.index');
        Route::post('/manajer/insight', [ManajerAIController::class, 'insight'])->name('ai.manajer.insight');
        Route::post('/manajer/laporan', [ManajerAIController::class, 'laporanRingkas'])->name('ai.manajer.laporan');
    });

});