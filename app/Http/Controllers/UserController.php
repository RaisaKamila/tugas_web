<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Ambil semua data dari tabel users
        return view('users.index', compact('users'));
    }
    public function create()
{
    return view('users.create'); // Menampilkan form tambah user
}

public function store(Request $request)
{
    $request->validate([
        'username' => 'required|unique:users|max:20',
        'password' => 'required|min:6',
        'role' => 'required|in:user,admin',
    ]);

    User::create([
        'username' => $request->username,
        'password' => md5($request->password), // Tetap menggunakan MD5
        'role' => $request->role
    ]);

    return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
}
public function edit($id)
{
    $user = User::findOrFail($id);
    return view('users.edit', compact('user')); // Menampilkan form edit user
}

public function update(Request $request, $id)
{
    $request->validate([
        'username' => 'required|max:20|unique:users,username,' . $id,
        'password' => 'nullable|min:6',
        'role' => 'required|in:user,admin',
    ]);

    $user = User::findOrFail($id);
    $user->username = $request->username;

    if ($request->password) {
        $user->password = md5($request->password); // Ubah password hanya jika diisi
    }

    $user->role = $request->role;
    $user->save();

    return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
}

}
