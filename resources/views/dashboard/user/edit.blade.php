@extends('dashboard.layouts.main')

@section('title', 'Edit User')
@section('navUser', 'active')

@section('content')

<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Edit User</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <form action="{{ route('dashboard.user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Lengkap -->
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" id="name"
                       placeholder="Masukkan nama lengkap"
                       value="{{ old('name', $user->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Username -->
            <div class="mb-3">
                <label for="username" class="form-label fw-semibold">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror"
                       name="username" id="username"
                       placeholder="Masukkan username"
                       value="{{ old('username', $user->username) }}">
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" id="email"
                       placeholder="Masukkan email"
                       value="{{ old('email', $user->email) }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Role -->
            <div class="mb-3">
                <label for="role" class="form-label fw-semibold">Role</label>
                <select class="form-select @error('role') is-invalid @enderror" name="role" id="role">
                    <option disabled selected>Pilih Role</option>
                    <option value="Jamaah" {{ old('role', $user->role) == 'Jamaah' ? 'selected' : '' }}>Jamaah</option>
                    <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Direktur Keuangan" {{ old('role', $user->role) == 'Direktur Keuangan' ? 'selected' : '' }}>Direktur Keuangan</option>
                    <option value="Pimpinan" {{ old('role', $user->role) == 'Pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password (Opsional)</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" id="password"
                       placeholder="Masukkan password baru (jika ingin mengubah)">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                <input type="password" class="form-control"
                       name="password_confirmation" id="password_confirmation"
                       placeholder="Ulangi password baru">
            </div> --}}

            <!-- Tombol -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('dashboard.user.index') }}" class="btn btn-secondary d-flex align-items-center">
                    <i class="bx bx-arrow-back me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-biru d-flex align-items-center">
                    <i class="bx bx-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
