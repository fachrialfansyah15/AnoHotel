<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $guest = Guest::with('user')->get();
        return view('guest.index', compact('guest'));
    }

    public function create()
    {
        // Hanya user dengan role 'tamu' yang bisa jadi data tamu
        $users = User::where('role', 'tamu')->get();
        return view('guest.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'phone'          => 'nullable|string|max:20',
            'id_card_number' => 'nullable|string|max:50',
            'address'        => 'nullable|string',
        ]);

        Guest::create($request->all());
        return redirect()->route('guest.index')->with('success', 'Data tamu berhasil ditambahkan.');
    }

    public function show(Guest $guest)
    {
        return view('guest.show', $guest->load('user'));
    }

    public function edit(Guest $guest)
    {
        $users = User::where('role', 'tamu')->get();
        return view('guest.edit', compact('guest', 'users'));
    }

    public function update(Request $request, Guest $guest)
    {
        $request->validate([
            'phone'          => 'nullable|string|max:20',
            'id_card_number' => 'nullable|string|max:50',
            'address'        => 'nullable|string',
        ]);

        $guest->update($request->only(['phone', 'id_card_number', 'address']));
        return redirect()->route('guest.index')->with('success', 'Data tamu berhasil diupdate.');
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();
        return redirect()->route('guest.index')->with('success', 'Data tamu berhasil dihapus.');
    }
}