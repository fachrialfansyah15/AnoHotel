<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Admin, Manajer, Resepsionis — lihat semua
    public function index()
    {
        $reservations = Reservation::with(['user', 'room'])->latest()->get();
        return view('reservations.index', compact('reservations'));
    }

    // Tamu — lihat reservasi milik sendiri
    public function myReservations()
    {
        $reservations = Reservation::with('room')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('reservations.my', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        // Tamu hanya bisa lihat milik sendiri
        if (Auth::user()->role === 'tamu' && $reservation->user_id !== Auth::id()) {
            abort(403);
        }
        return view('reservations.show', $reservation->load(['room', 'payment']));
    }

    // Admin, Resepsionis & Tamu
    public function create()
    {
        $rooms = Room::where('status', 'available')->get();
        return view('reservations.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id'      => 'required|exists:rooms,id',
            'check_in'     => 'required|date|after_or_equal:today',
            'check_out'    => 'required|date|after:check_in',
            'total_guest' => 'required|integer|min:1',
            'notes'        => 'nullable|string',
        ]);

        Reservation::create([
            'user_id'      => Auth::id(),
            'room_id'      => $request->room_id,
            'check_in'     => $request->check_in,
            'check_out'    => $request->check_out,
            'total_guest'  => $request->total_guest,
            'notes'        => $request->notes,
            'status'       => 'pending',
        ]);

        return redirect()->route('reservations.my')->with('success', 'Reservasi berhasil dibuat.');
    }

    // Admin, Manajer & Resepsionis
    public function edit(Reservation $reservation)
    {
        $rooms = Room::all();
        return view('reservations.edit', compact('reservation', 'rooms'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status'       => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
            'check_in'     => 'required|date',
            'check_out'    => 'required|date|after:check_in',
            'total_guest' => 'required|integer|min:1',
            'notes'        => 'nullable|string',
        ]);

        $reservation->update($request->all());
        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil diupdate.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil dihapus.');
    }
}