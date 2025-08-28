<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan form login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authentikasi bawaan Breeze
        $request->authenticate();

        // Regenerasi session biar aman
        $request->session()->regenerate();

        // Redirect sesuai role user
        $role = Auth::user()->role;

        return match ($role) {
            'admin' => redirect()->intended('/admin/dashboard'),
            'guru'  => redirect()->intended('/guru/dashboard'),
            'siswa' => redirect()->intended('/siswa/dashboard'),
            default => redirect()->intended('/'),
        };
    }

    /**
     * Logout user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
