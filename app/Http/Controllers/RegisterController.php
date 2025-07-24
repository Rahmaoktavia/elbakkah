<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('register');
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
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'username' => 'required|string|min:3|max:100|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
            'captcha' => 'required|captcha',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'Jamaah', // Default role saat register
            'foto_profil' => null, // Default kosong
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Redirect ke login dengan pesan
        return redirect()->route('login')->with('pesan', 'Registrasi berhasil, silakan login.');
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
