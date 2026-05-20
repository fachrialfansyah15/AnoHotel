<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AI\TamuAIController;
use App\Http\Controllers\AI\ResepsionisAIController;
use App\Http\Controllers\AI\ManajerAIController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => redirect()->route('login'));

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
*/
// Auth
Route::get('/login',    [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register',[AuthController::class, 'register'])->name('register.post');
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | USERS
    |--------------------------------------------------------------------------
    */
    // ✅ CRUD User — Admin only
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | ROOMS
    |--------------------------------------------------------------------------
    */
    // ✅ Lihat Kamar (Daftar) — Semua Role (Admin, Manager, Receptionist, Guest)
    Route::get('rooms', [RoomController::class, 'index'])->name('rooms.index');

    // ✅ Kelola Kamar — Admin & Manager
    Route::middleware('role:admin,manager')->group(function () {
        Route::post('rooms',            [RoomController::class, 'store'])->name('rooms.store');
        Route::get('rooms/create',      [RoomController::class, 'create'])->name('rooms.create');
        Route::put('rooms/{room}',      [RoomController::class, 'update'])->name('rooms.update');
        Route::delete('rooms/{room}',   [RoomController::class, 'destroy'])->name('rooms.destroy');
        Route::get('rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    });

    // ✅ Update Status Kamar — Admin, Manager & Housekeeping
    Route::middleware('role:admin,manager,housekeeping')->group(function () {
        Route::patch('rooms/{room}/status', [RoomController::class, 'updateStatus'])->name('rooms.updateStatus');
    });

    // ✅ Lihat Kamar (Detail) — Semua Role
    Route::get('rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

    /*
    |--------------------------------------------------------------------------
    | RESERVATIONS
    |--------------------------------------------------------------------------
    */
    // ✅ Kelola Reservasi (Kecuali Buat) — Admin, Manager & Receptionist
    Route::middleware('role:admin,manager,receptionist')->group(function () {
        Route::get('reservations',                          [ReservationController::class, 'index'])->name('reservations.index');
        Route::get('reservations/{reservation}/edit',       [ReservationController::class, 'edit'])->name('reservations.edit');
        Route::put('reservations/{reservation}',            [ReservationController::class, 'update'])->name('reservations.update');
        Route::delete('reservations/{reservation}',         [ReservationController::class, 'destroy'])->name('reservations.destroy');
    });

    // ✅ Buat Reservasi — Admin, Receptionist & Guest (Manajer tidak bisa)
    Route::middleware('role:admin,receptionist,guest')->group(function () {
        Route::get('reservations/create',  [ReservationController::class, 'create'])->name('reservations.create');
        Route::post('reservations',        [ReservationController::class, 'store'])->name('reservations.store');
    });

    // ✅ Lihat Reservasi Sendiri — Guest
    Route::middleware('role:guest')->group(function () {
        Route::get('my-reservations',                   [ReservationController::class, 'myReservations'])->name('reservations.my');
        Route::get('my-reservations/{reservation}',     [ReservationController::class, 'show'])->name('reservations.show');
        Route::post('my-reservations/{reservation}/cancel', [ReservationController::class, 'cancelReservation'])->name('reservations.cancel');
    });

    /*
    |--------------------------------------------------------------------------
    | PAYMENTS
    |--------------------------------------------------------------------------
    */
    // ✅ Kelola Pembayaran — Admin, Manager & Receptionist
    Route::middleware('role:admin,manager,receptionist')->group(function () {
        Route::resource('payments', PaymentController::class);
    });

    // ✅ Lihat Pembayaran Sendiri — Guest
    Route::middleware('role:guest')->group(function () {
        Route::get('my-payments', [PaymentController::class, 'myPayments'])->name('payments.my');
        Route::post('my-payments/{payment}/pay', [PaymentController::class, 'pay'])->name('payments.pay');
    });

    /*
    |--------------------------------------------------------------------------
    | REPORTS
    |--------------------------------------------------------------------------
    */
    // ✅ Lihat Laporan — Admin & Manager
    Route::middleware('role:admin,manager')->group(function () {
        Route::get('reports', function () {
            $totalRevenue = \App\Models\Payment::sum('amount');
            $totalReservations = \App\Models\Reservation::count();
            $totalGuests = \App\Models\User::where('role', 'guest')->count();
            $availableRooms = \App\Models\Room::where('status', 'available')->count();
            
            return view('reports.index', compact(
                'totalRevenue',
                'totalReservations',
                'totalGuests',
                'availableRooms'
            ));
        })->name('reports.index');
    });

    /*
    |--------------------------------------------------------------------------
    | AI PAGES
    |--------------------------------------------------------------------------
    */
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