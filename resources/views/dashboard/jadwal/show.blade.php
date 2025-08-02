@extends('dashboard.layouts.main')

@section('title', 'Detail Jadwal Keberangkatan')
@section('navPaket', 'active')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h4 class="text-dark fw-bold mb-0">Detail Jadwal Keberangkatan</h4>
    </div>

    <div class="card-body bg-light">
        {{-- Informasi Utama --}}
        <div class="row mb-4 gx-5">
            <!-- Nama Paket -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Nama Paket</label>
                <div class="text-secondary border-bottom pb-1">{{ $jadwal->paket->nama_paket }}</div>
            </div>

            <!-- Tanggal Keberangkatan -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Tanggal Keberangkatan</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ \Carbon\Carbon::parse($jadwal->tanggal_berangkat)->translatedFormat('d F Y') }}
                </div>
            </div>

            <!-- Kuota -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Kuota Jamaah</label>
                <div class="text-secondary border-bottom pb-1">{{ $jadwal->kuota ?? '-' }}</div>
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('dashboard.jadwal.index') }}" class="btn btn-secondary px-4 py-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
