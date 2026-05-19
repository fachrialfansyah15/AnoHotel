<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan semua user — Admin only
    public function index()
    {
        $this->authorize('manage-users');
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('manage-users');
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->authorize('manage-users');
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,manager,receptionist,guest',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        $this->authorize('manage-users');
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('manage-users');
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('manage-users');
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:admin,manager,receptionist,guest',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        $this->authorize('manage-users');
        if ($user->id === auth()->id()) {
    return back()->with(
        'error',
        'You cannot delete your own account.'
    );
}

$user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}