@extends('dashboard.layouts.main')

@section('title', 'Detail User')
@section('navUser', 'active')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h4 class="text-dark fw-bold mb-0">Detail User</h4>
    </div>

    <div class="card-body bg-light">
        {{-- Informasi Utama --}}
        <div class="row mb-4 gx-5">
            <!-- Nama Lengkap -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Nama Lengkap</label>
                <div class="text-secondary border-bottom pb-1">{{ $user->name }}</div>
            </div>

            <!-- Username -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Username</label>
                <div class="text-secondary border-bottom pb-1">{{ $user->username }}</div>
            </div>

            <!-- Email -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Email</label>
                <div class="text-secondary border-bottom pb-1">{{ $user->email }}</div>
            </div>

            <!-- Role -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Role</label>
                <div class="text-secondary border-bottom pb-1">{{ ucfirst($user->role) }}</div>
            </div>

            <!-- Tanggal Registrasi -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Tanggal Registrasi</label>
                <div class="text-secondary border-bottom pb-1">{{ $user->created_at->translatedFormat('d F Y, H:i') }}</div>
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('dashboard.user.index') }}" class="btn btn-secondary px-4 py-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
