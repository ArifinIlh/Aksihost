<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10); // tampilkan semua user
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('orders'); // eager loading relasi 'orders'
    
        return view('admin.users.show', compact('user'));
    }
    

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'status' => 'required|in:active,suspended',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }

    public function create()
{
    return view('admin.users.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'user',
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
}
public function toggle(User $user)
{
    $user->status = $user->status === 'active' ? 'suspended' : 'active';
    $user->save();

    $statusMsg = $user->status === 'active' ? 'diaktifkan' : 'disuspend';
    return redirect()->route('admin.users.index')->with('success', "User berhasil $statusMsg.");
}

}
