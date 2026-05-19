<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

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

    Route::resource('users', UserController::class);

    /*
    |--------------------------------------------------------------------------
    | ROOMS
    |--------------------------------------------------------------------------
    */

    Route::resource('rooms', RoomController::class);

    Route::patch(
        'rooms/{room}/status',
        [RoomController::class, 'updateStatus']
    )->name('rooms.updateStatus');

    /*
    |--------------------------------------------------------------------------
    | RESERVATIONS
    |--------------------------------------------------------------------------
    */

    /*
|--------------------------------------------------------------------------
| RESERVATIONS
|--------------------------------------------------------------------------
*/

/**
 * MANAGEMENT
 */
Route::resource(
    'reservations',
    ReservationController::class
)->except([
    'index'
]);

/**
 * ADMIN / MANAGER / RECEPTIONIST
 */
Route::get(
    '/reservations',
    [ReservationController::class, 'index']
)->name('reservations.index');

/**
 * GUEST
 */
Route::get(
    '/my-reservations',
    [ReservationController::class, 'myReservations']
)->name('reservations.my');

    /*
    |--------------------------------------------------------------------------
    | GUEST PAGES
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/my-reservations',
        [ReservationController::class, 'myReservations']
    )->name('reservations.my');

    Route::get(
        '/my-payments',
        [PaymentController::class, 'myPayments']
    )->name('payments.my');

    /*
    |--------------------------------------------------------------------------
    | PAYMENTS
    |--------------------------------------------------------------------------
    */

   /*
|--------------------------------------------------------------------------
| PAYMENTS
|--------------------------------------------------------------------------
*/

/**
 * MANAGEMENT
 */
Route::resource(
    'payments',
    PaymentController::class
)->except([
    'index'
]);

/**
 * ADMIN / MANAGER / RECEPTIONIST
 */
Route::get(
    '/payments',
    [PaymentController::class, 'index']
)->name('payments.index');

/**
 * GUEST
 */
Route::get(
    '/my-payments',
    [PaymentController::class, 'myPayments']
)->name('payments.my');
    /*
    |--------------------------------------------------------------------------
    | REPORTS
    |--------------------------------------------------------------------------
    */

    Route::get('/reports', function () {

    $totalRevenue = \App\Models\Payment::sum('amount');

    $totalReservations = \App\Models\Reservation::count();

    $totalGuests = \App\Models\User::where(
        'role',
        'guest'
    )->count();

    $availableRooms = \App\Models\Room::where(
        'status',
        'available'
    )->count();

    return view('reports.index', compact(
        'totalRevenue',
        'totalReservations',
        'totalGuests',
        'availableRooms'
    ));

})->name('reports.index');

    /*
    |--------------------------------------------------------------------------
    | AI PAGES
    |--------------------------------------------------------------------------
    */

    Route::get('/ai/chat', function () {
        return view('ai.chat');
    })->name('ai.chat');

    Route::get('/ai/recommend', function () {
        return view('ai.recommend');
    })->name('ai.recommend');

});