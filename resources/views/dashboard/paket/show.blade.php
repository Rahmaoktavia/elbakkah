@extends('dashboard.layouts.main')

@section('title', 'Detail Paket Umrah')
@section('navPaket', 'active') {{-- Sesuaikan dengan nav yang kamu pakai --}}

@section('content')

<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Detail Paket Umrah</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <!-- Nama Paket -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Paket</label>
            <div class="form-control bg-light">{{ $paket->nama_paket }}</div>
        </div>

        <!-- Harga -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Harga</label>
            <div class="form-control bg-light">Rp {{ number_format($paket->harga, 2, ',', '.') }}</div>
        </div>

        <!-- Jumlah Hari -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Durasi Perjalanan</label>
            <div class="form-control bg-light">{{ $paket->jumlah_hari }} Hari</div>
        </div>

        <!-- Fasilitas -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Fasilitas</label>
            <div class="form-control bg-light">{{ $paket->fasilitas }}</div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Deskripsi</label>
            <div class="form-control bg-light">{{ $paket->deskripsi ?? '-' }}</div>
        </div>

        <!-- Gambar Paket -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Gambar Paket</label><br>
            @if ($paket->gambar_paket)
                <img src="{{ asset('img/' . $paket->gambar_paket) }}" alt="Gambar Paket" class="img-thumbnail mt-2" style="max-height: 250px;">
            @else
                <div class="form-control bg-light">Tidak ada gambar.</div>
            @endif
        </div>

        <!-- Tombol -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('dashboard.paket.index') }}" class="btn btn-secondary d-flex align-items-center">
                <i class="bx bx-arrow-back me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>

@endsection
