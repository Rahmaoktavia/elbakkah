@extends('dashboard.layouts.main')

@section('title', 'Detail Paket Umrah')
@section('navPaket', 'active')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h4 class="text-dark fw-bold mb-0">Detail Paket Umrah</h4>
    </div>

    <div class="card-body bg-light">
        {{-- Informasi Utama --}}
        <div class="row mb-4 gx-5">
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Nama Paket</label>
                <div class="text-secondary border-bottom pb-1">{{ $paket->nama_paket }}</div>
            </div>

            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Tipe Paket</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ $paket->tipePaket->nama_tipe ?? '-' }}
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Harga</label>
                <div class="text-secondary border-bottom pb-1">Rp {{ number_format($paket->harga, 2, ',', '.') }}</div>
            </div>

            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Durasi Perjalanan</label>
                <div class="text-secondary border-bottom pb-1">{{ $paket->jumlah_hari }} Hari</div>
            </div>

            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Hotel di Makkah</label>
                <div class="text-secondary border-bottom pb-1">{{ $paket->hotel_makkah ?? '-' }}</div>
            </div>

            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Hotel di Madinah</label>
                <div class="text-secondary border-bottom pb-1">{{ $paket->hotel_madinah ?? '-' }}</div>
            </div>

            <div class="col-md-12 mb-4">
                <label class="fw-bold text-dark">Fasilitas</label>
                <div class="text-secondary border-bottom pb-2">{{ $paket->fasilitas }}</div>
            </div>

            <div class="col-md-12 mb-4">
                <label class="fw-bold text-dark">Deskripsi</label>
                <div class="text-secondary border-bottom pb-2">{{ $paket->deskripsi ?? '-' }}</div>
            </div>
        </div>

        {{-- Gambar Paket --}}
        <div class="mb-4">
            <label class="fw-bold text-dark d-block mb-3 fs-5 text-center">Gambar Paket Umrah</label>
            @if ($paket->gambar_paket)
                <div class="shadow-sm border-0" 
                    style="background-color: #ffffff; max-width: 500px; margin: 0 auto;">
                    <img src="{{ asset('img/' . $paket->gambar_paket) }}"
                        alt="Gambar Paket"
                        class="img-fluid rounded w-100"
                        style="object-fit: contain;">
                </div>
            @else
                <p class="text-secondary text-center">Tidak ada gambar.</p>
            @endif
        </div>

        {{-- Tombol Kembali --}}
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('dashboard.paket.index') }}" class="btn btn-secondary px-4 py-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
