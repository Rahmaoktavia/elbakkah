@extends('dashboard.layouts.main')

@section('title', 'Edit Tipe Paket')
@section('navTipePaket', 'active')

@section('content')

<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Edit Tipe Paket</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <form action="{{ route('dashboard.tipe-paket.update', $tipePaket->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Tipe -->
            <div class="mb-3">
                <label for="nama_tipe" class="form-label fw-semibold">Nama Tipe</label>
                <input type="text"
                       class="form-control @error('nama_tipe') is-invalid @enderror"
                       name="nama_tipe" id="nama_tipe"
                       placeholder="Masukkan nama tipe"
                       value="{{ old('nama_tipe', $tipePaket->nama_tipe) }}">
                @error('nama_tipe')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('dashboard.tipe-paket.index') }}" class="btn btn-secondary d-flex align-items-center">
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
