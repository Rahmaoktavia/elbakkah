@extends('dashboard.layouts.main')

@section('title', 'Detail Galeri')
@section('navGaleri', 'active')

@section('content')

<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Detail Galeri</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <!-- Judul Foto -->
        <div class="mb-3">
            <label for="judul_foto" class="form-label fw-semibold">Judul Foto</label>
            <div class="form-control bg-light">{{ $galeri->judul_foto }}</div>
        </div>

        <!-- Tanggal Upload -->
        <div class="mb-3">
            <label for="tanggal_upload" class="form-label fw-semibold">Tanggal Upload</label>
            <div class="form-control bg-light">
                {{ \Carbon\Carbon::parse($galeri->tanggal_upload)->format('d-m-Y') }}
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
            <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
            <div class="form-control bg-light">
                {{ $galeri->deskripsi ?? '-' }}
            </div>
        </div>

        <!-- Foto -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Foto</label><br>
            @if ($galeri->file_foto)
                <img src="{{ asset('img/' . $galeri->file_foto) }}" alt="Foto Galeri" class="img-thumbnail mt-2" style="max-height: 250px;">
            @else
                <div class="form-control bg-light">Tidak ada foto.</div>
            @endif
        </div>

        <!-- Tombol -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('dashboard.galeri.index') }}" class="btn btn-secondary d-flex align-items-center">
                <i class="bx bx-arrow-back me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>

@endsection
