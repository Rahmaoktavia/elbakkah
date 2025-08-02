@extends('dashboard.layouts.main')

@section('title', 'Detail Galeri')
@section('navGaleri', 'active')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h4 class="text-dark fw-bold mb-0">Detail Galeri</h4>
    </div>

    <div class="card-body bg-light">
        {{-- Informasi Galeri --}}
        <div class="row mb-4 gx-5">
            <!-- Judul Foto -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Judul Foto</label>
                <div class="text-secondary border-bottom pb-1">{{ $galeri->judul_foto }}</div>
            </div>

            <!-- Tanggal Upload -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Tanggal Upload</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ \Carbon\Carbon::parse($galeri->tanggal_upload)->translatedFormat('d F Y') }}
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="col-md-12 mb-4">
                <label class="fw-bold text-dark">Deskripsi</label>
                <div class="text-secondary border-bottom pb-2">{{ $galeri->deskripsi ?? '-' }}</div>
            </div>
        </div>

        {{-- Gambar Galeri --}}
        <div class="text-center mb-4">
            <label class="fw-bold text-dark d-block mb-3 fs-5">Foto Galeri</label>
            @if ($galeri->file_foto)
                <div class="card mx-auto shadow-sm border-0 p-4" style="max-width: 600px; background-color: #ffffff;">
                    <img src="{{ asset('img/' . $galeri->file_foto) }}"
                         alt="Foto Galeri"
                         class="img-fluid rounded"
                         style="max-height: 400px; object-fit: cover; width: 100%;">
                </div>
            @else
                <p class="text-secondary">Tidak ada foto.</p>
            @endif
        </div>

        {{-- Tombol Kembali --}}
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('dashboard.galeri.index') }}" class="btn btn-secondary px-4 py-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
