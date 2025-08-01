<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan halaman login
        return view('login');
    }

    /**
     * Menangani percobaan autentikasi pengguna.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            switch ($user->role) {
                case 'Jamaah':
                    return redirect()->route('home')->with('success', 'Selamat datang, ' . $user->name);
                
                case 'Admin':
                case 'Direktur Keuangan':
                case 'Pimpinan':
                    return redirect()->route('dashboard.index')->with('success', 'Selamat datang, ' . $user->name);
                
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors([
                        'email' => 'Role pengguna tidak dikenali.',
                    ]);
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password yang dimasukkan tidak cocok.',
        ])->withInput($request->only('email'));
    }


    /**
     * Menangani logout dan pembersihan sesi.
     */
    public function logout(Request $request): RedirectResponse
    {
        // Simpan role sebelum logout karena setelah logout tidak bisa akses Auth::user()
        $role = Auth::user()->role;

        // Logout user
        Auth::logout();

        // Invalidate session dan regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect berdasarkan role
        if ($role === 'Jamaah') {
            return redirect()->route('home')->with('success', 'Anda telah berhasil logout.');
        } elseif (in_array($role, ['Admin', 'Direktur Keuangan', 'Pimpinan'])) {
           return redirect('/login')->with('success', 'Anda telah berhasil logout.');
        }

        // Default redirect jika role tidak dikenali
        return redirect()->route('home')->with('success', 'Anda telah berhasil logout.');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
