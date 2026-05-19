<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
{
    $user = auth()->user();

    // GUEST
    if ($user->role === 'guest') {

        $myReservations = Reservation::where(
            'user_id',
            $user->id
        )->count();

        $myPayments = Payment::count();

        $availableRooms = Room::where(
            'status',
            'available'
        )->count();

        return view('dashboard.guest', compact(
            'myReservations',
            'myPayments',
            'availableRooms'
        ));
    }

    // MANAGEMENT
    $totalUsers = User::count();

    $totalRooms = Room::count();

    $totalReservations = Reservation::count();

    $totalPayments = Payment::count();

    return view('dashboard.management', compact(
        'totalUsers',
        'totalRooms',
        'totalReservations',
        'totalPayments'
    ));
}
}