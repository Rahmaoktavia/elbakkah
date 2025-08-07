@extends('dashboard.layouts.main')

@section('title', 'Detail Distribusi Perlengkapan')
@section('navDistribusi', 'active')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h4 class="text-dark fw-bold mb-0">Detail Distribusi Perlengkapan</h4>
    </div>

    <div class="card-body bg-light">
        {{-- Informasi Utama --}}
        <div class="row mb-4 gx-5">
            <!-- Nama Jamaah -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Nama Jamaah</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ $distribusi->jamaah->nama_jamaah ?? '-' }}
                </div>
            </div>

            <!-- Nama Perlengkapan -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Nama Perlengkapan</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ $distribusi->perlengkapan->nama_perlengkapan ?? '-' }}
                </div>
            </div>

            <!-- Jumlah Diberikan -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Jumlah Diberikan</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ $distribusi->jumlah_diberikan }} {{ $distribusi->perlengkapan->satuan ?? '' }}
                </div>
            </div>

            <!-- Tanggal Distribusi -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Tanggal Distribusi</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ \Carbon\Carbon::parse($distribusi->tanggal_distribusi)->translatedFormat('d F Y') }}
                </div>
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('dashboard.distribusi.index') }}" class="btn btn-secondary px-4 py-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
