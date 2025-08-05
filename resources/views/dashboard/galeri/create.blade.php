@extends('dashboard.layouts.main')

@section('title', 'Tambah Galeri')
@section('navGaleri', 'active')

@section('content')

<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Tambah Galeri</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <form action="{{ route('dashboard.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Judul Foto -->
            <div class="mb-3">
                <label for="judul_foto" class="form-label fw-semibold">Judul</label>
                <input type="text" class="form-control @error('judul_foto') is-invalid @enderror"
                       name="judul_foto" id="judul_foto" placeholder="Masukkan judul" value="{{ old('judul_foto') }}">
                @error('judul_foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- File Foto -->
            <div class="mb-3">
                <label for="file_foto" class="form-label fw-semibold">Unggah Foto</label>
                <input type="file" class="form-control @error('file_foto') is-invalid @enderror"
                       name="file_foto" id="file_foto">
                @error('file_foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                          name="deskripsi" id="deskripsi" rows="3"
                          placeholder="Tambahkan deskripsi jika ada">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Simpan -->
                <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('dashboard.galeri.index') }}" class="btn btn-secondary d-flex align-items-center">
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
