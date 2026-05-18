<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Semua role bisa lihat
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    // Admin & Manajer
    public function create()
    {
        $this->authorize('manage-rooms');
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $this->authorize('manage-rooms');
        $request->validate([
            'room_number'    => 'required|unique:rooms',
            'type'           => 'required|in:standard,deluxe,suite',
            'price_per_night'=> 'required|numeric|min:0',
            'capacity'       => 'required|integer|min:1',
            'description'    => 'nullable|string',
        ]);

        Room::create($request->all());
        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function edit(Room $room)
    {
        $this->authorize('manage-rooms');
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $this->authorize('manage-rooms');
        $request->validate([
            'room_number'    => 'required|unique:rooms,room_number,' . $room->id,
            'type'           => 'required|in:standard,deluxe,suite',
            'price_per_night'=> 'required|numeric|min:0',
            'capacity'       => 'required|integer|min:1',
            'description'    => 'nullable|string',
        ]);

        $room->update($request->all());
        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil diupdate.');
    }

    public function destroy(Room $room)
    {
        $this->authorize('manage-rooms');
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil dihapus.');
    }

    // Admin & Manajer
    public function updateStatus(Request $request, Room $room)
    {
        $this->authorize('update-room-status');
        $request->validate([
            'status' => 'required|in:available,occupied,maintenance',
        ]);

        $room->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status kamar berhasil diupdate.');
    }
}