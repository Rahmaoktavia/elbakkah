@extends('dashboard.layouts.main')

@section('title', 'Detail Inventaris Perlengkapan')
@section('navInventaris', 'active')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h4 class="text-dark fw-bold mb-0">Detail Inventaris Perlengkapan</h4>
    </div>

    <div class="card-body bg-light">
        <div class="row mb-4 gx-5">
            <!-- Nama Perlengkapan -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Nama Perlengkapan</label>
                <div class="text-secondary border-bottom pb-1">{{ $inventaris->nama_perlengkapan }}</div>
            </div>

            <!-- Jumlah Total -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Jumlah Total</label>
                <div class="text-secondary border-bottom pb-1">{{ $inventaris->jumlah_total }}</div>
            </div>

            <!-- Jumlah Tersedia -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Jumlah Tersedia</label>
                <div class="text-secondary border-bottom pb-1">{{ $inventaris->jumlah_tersedia }}</div>
            </div>

            <!-- Satuan -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Satuan</label>
                <div class="text-secondary border-bottom pb-1">{{ $inventaris->satuan }}</div>
            </div>

            <!-- Tanggal Input -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Tanggal Input</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ \Carbon\Carbon::parse($inventaris->tanggal_input)->translatedFormat('d F Y') }}
                </div>
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('dashboard.inventaris.index') }}" class="btn btn-secondary px-4 py-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
