<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Senaraikan semua pengguna
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Papar borang untuk mencipta pengguna baru
    public function create()
    {
        return view('admin.users.create');
    }

    // Simpan pengguna baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'ic_number' => 'required|unique:users',
            'password' => 'required|min:8',
            'kategori' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'ic_number' => $request->ic_number,
            'password' => Hash::make($request->password),
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berjaya dicipta.');
    }

    // Papar borang untuk mengedit pengguna
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Kemaskini maklumat pengguna
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'ic_number' => 'required|unique:users,ic_number,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'kategori' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'ic_number' => $request->ic_number,
            'kategori' => $request->kategori,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'Maklumat pengguna berjaya dikemaskini.');
    }

    // Padam pengguna
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Pengguna berjaya dipadam.');
    }
}
