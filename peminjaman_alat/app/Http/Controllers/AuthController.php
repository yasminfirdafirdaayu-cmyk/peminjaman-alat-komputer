<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // MENAMPILKAN HALAMAN LOGIN
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return view('login');
    }

    // PROSES LOGIN
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password salah.',
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return $this->redirectByRole();
    }

    // MENAMPILKAN HALAMAN REGISTER
    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return view('auth.register');
    }

    // PROSES REGISTER KHUSUS PEMINJAM
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),

            // Semua pendaftaran umum otomatis menjadi peminjam.
            // Role dari formulir tidak digunakan.
            'role' => 'peminjam',
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // PENGALIHAN DASHBOARD BERDASARKAN ROLE
    private function redirectByRole()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $role = strtolower(trim($user->role ?? ''));

        $routes = [
            'admin' => 'dashboard.admin',
            'petugas' => 'dashboard.petugas',
            'peminjam' => 'dashboard.peminjam',
        ];

        if (!isset($routes[$role])) {
            Auth::logout();

            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Role akun tidak dikenali.',
                ]);
        }

        return redirect()->route($routes[$role]);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Berhasil logout. Sampai jumpa!');
    }
}
