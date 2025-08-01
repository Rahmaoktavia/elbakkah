@extends('dashboard.layouts.main')

@section('title', 'Detail Pemesanan')
@section('navPemesanan', 'active')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h4 class="text-dark fw-bold mb-0">Detail Pemesanan</h4>
    </div>

    <div class="card-body bg-light">
        {{-- Informasi Utama --}}
        <div class="row mb-4 gx-5">
            <!-- Nama Jamaah -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Nama Jamaah</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ $pemesanan->jamaah->nama_jamaah ?? '-' }}
                </div>
            </div>

            <!-- Nama Paket -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Nama Paket</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ $pemesanan->jadwalKeberangkatan->paket->nama_paket ?? '-' }}
                </div>
            </div>

            <!-- Tanggal Keberangkatan -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Tanggal Keberangkatan</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ \Carbon\Carbon::parse($pemesanan->jadwalKeberangkatan->tanggal_berangkat)->translatedFormat('d F Y') }}
                </div>
            </div>

            <!-- Tanggal Pemesanan -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Tanggal Pemesanan</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ \Carbon\Carbon::parse($pemesanan->tanggal_pesan)->translatedFormat('d F Y') }}
                </div>
            </div>

            <!-- Total Tagihan -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Total Tagihan</label>
                <div class="text-secondary border-bottom pb-1">
                    Rp {{ number_format($pemesanan->total_tagihan, 0, ',', '.') }}
                </div>
            </div>

            <!-- Status Pembayaran -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Status Pembayaran</label>
                <div class="text-secondary border-bottom pb-1">
                    <span class="badge {{ $pemesanan->status_pembayaran == 'Lunas' ? 'bg-success' : 'bg-warning text-dark' }}">
                        {{ $pemesanan->status_pembayaran }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('dashboard.pemesanan.index') }}" class="btn btn-secondary px-4 py-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
