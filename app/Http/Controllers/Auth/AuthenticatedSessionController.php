<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

public function store(Request $request): RedirectResponse
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (!Auth::attempt($credentials, $request->boolean('remember'))) {
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    $request->session()->regenerate();

    $user = Auth::user();

    
    if ($user->status === 'suspended') {
        Auth::logout();

        return back()->withErrors([
            'email' => 'Akun Anda telah disuspend. Silakan hubungi admin.',
        ]);
    }

  
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');
}


    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }
}
