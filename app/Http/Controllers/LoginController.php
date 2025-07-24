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
        // Validasi input login (email dan password)
        $credentials = $request->validate([
            'email' => ['required', 'email'], // Email harus ada dan dalam format yang valid
            'password' => ['required'], // Password harus ada
        ]);

        // Mencoba autentikasi dengan kredensial yang diberikan (email dan password)
        if (Auth::attempt($credentials)) {
            // Regenerasi sesi untuk melindungi dari serangan session fixation
            $request->session()->regenerate();

            // Mendapatkan data pengguna yang sedang login
            $user = Auth::user();

            // Redirect berdasarkan peran pengguna (role)
            if ($user->role === 'Jamaah') {
                // Jika pengguna adalah customer, redirect ke halaman home customer
                return redirect()->route('home')->with('success', 'Welcome ' . $user->name);
            } elseif (in_array($user->role, ['Admin', 'Direktur Keuangan', 'Pimpinan'])) {
                // Jika pengguna adalah admin, super_admin, atau kurir, redirect ke dashboard
                return redirect()->route('dashboard.index')->with('success', 'Welcome ' . $user->name);
            }

            // Default redirect jika peran pengguna tidak dikenali (redirect ke halaman home umum)
            return redirect()->intended('home')->with('success', 'Welcome ' . $user->name);
        }

        // Jika autentikasi gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang dimasukkan tidak cocok.', // Pesan error untuk email yang tidak sesuai
        ])->withInput($request->only('email')); // Menyertakan input email yang dimasukkan sebelumnya
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
