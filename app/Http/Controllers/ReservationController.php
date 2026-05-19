<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * ADMIN / MANAGER / RECEPTIONIST
     * Lihat semua reservasi
     */
    public function index()
{
    $this->authorize('manage-reservations');

    $reservations = Reservation::with([
        'user',
        'room'
    ])->latest()->get();

    $rooms = Room::where(
        'status',
        'available'
    )->get();

    return view(
        'reservations.index',
        compact(
            'reservations',
            'rooms'
        )
    );
}

    /**
     * GUEST
     * Reservasi milik sendiri
     */
    public function myReservations()
    {
        $this->authorize('view-own-reservations');

        $reservations = Reservation::with([
            'room',
            'payment'
        ])
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

        return view(
            'reservations.my',
            compact('reservations')
        );
    }

    /**
     * DETAIL RESERVASI
     */
    public function show(Reservation $reservation)
    {
        // Guest hanya boleh lihat miliknya
        if (
            Auth::user()->role === 'guest' &&
            $reservation->user_id !== Auth::id()
        ) {
            abort(403);
        }

        $reservation->load([
            'user',
            'room',
            'payment'
        ]);

        return view(
            'reservations.show',
            compact('reservation')
        );
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        $this->authorize('create-reservation');

        $rooms = Room::where(
            'status',
            'available'
        )->get();

        return view(
            'reservations.create',
            compact('rooms')
        );
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $this->authorize('create-reservation');

        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'total_guest' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_guest' => $request->total_guest,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        // Redirect sesuai role
        if (Auth::user()->role === 'guest') {
            return redirect()
                ->route('reservations.my')
                ->with(
                    'success',
                    'Reservation created successfully.'
                );
        }

        return redirect()
            ->route('reservations.index')
            ->with(
                'success',
                'Reservation created successfully.'
            );
    }

    /**
     * FORM EDIT
     */
    public function edit(Reservation $reservation)
    {
        $this->authorize('manage-reservations');

        $rooms = Room::all();

        return view(
            'reservations.edit',
            compact(
                'reservation',
                'rooms'
            )
        );
    }

    /**
     * UPDATE
     */
    public function update(
        Request $request,
        Reservation $reservation
    ) {
        $this->authorize('manage-reservations');

        $request->validate([
            'room_id' => 'required|exists:rooms,id',

            'status' => 'required|in:
                pending,
                confirmed,
                checked_in,
                checked_out,
                cancelled',

            'check_in' => 'required|date',

            'check_out' => 'required|date|after:check_in',

            'total_guest' => 'required|integer|min:1',

            'notes' => 'nullable|string',
        ]);

        $reservation->update([
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_guest' => $request->total_guest,
            'notes' => $request->notes,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('reservations.index')
            ->with(
                'success',
                'Reservation updated successfully.'
            );
    }

    /**
     * DELETE
     */
    public function destroy(Reservation $reservation)
    {
        $this->authorize('manage-reservations');

        $reservation->delete();

        return redirect()
            ->route('reservations.index')
            ->with(
                'success',
                'Reservation deleted successfully.'
            );
    }
}