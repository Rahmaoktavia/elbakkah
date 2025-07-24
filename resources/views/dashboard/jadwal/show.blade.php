@extends('dashboard.layouts.main')

@section('title', 'Detail Jadwal Keberangkatan')
@section('navPaket', 'active') {{-- Sesuaikan dengan menu navigasi --}}

@section('content')

<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Detail Jadwal Keberangkatan</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <!-- Nama Paket -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Paket</label>
            <div class="form-control bg-light">{{ $jadwal->paket->nama_paket }}</div>
        </div>

        <!-- Tanggal Keberangkatan -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Tanggal Keberangkatan</label>
            <div class="form-control bg-light">{{ \Carbon\Carbon::parse($jadwal->tanggal_berangkat)->format('d F Y') }}</div>
        </div>

        <!-- Kuota -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Kuota Jamaah</label>
            <div class="form-control bg-light">{{ $jadwal->kuota ?? '-' }}</div>
        </div>

        <!-- Tombol -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('dashboard.jadwal.index') }}" class="btn btn-secondary d-flex align-items-center">
                <i class="bx bx-arrow-back me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>

@endsection
