@extends('dashboard.layouts.main')

@section('title', 'Edit Galeri')
@section('navGaleri', 'active')

@section('content')

<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Edit Galeri</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <form action="{{ route('dashboard.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Judul Foto -->
            <div class="mb-3">
                <label for="judul_foto" class="form-label fw-semibold">Judul</label>
                <input type="text" class="form-control @error('judul_foto') is-invalid @enderror"
                       name="judul_foto" id="judul_foto"
                       placeholder="Masukkan judul foto"
                       value="{{ old('judul_foto', $galeri->judul_foto) }}">
                @error('judul_foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                          name="deskripsi" id="deskripsi" rows="3"
                          placeholder="Masukkan deskripsi (opsional)">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Ganti Foto -->
            <div class="mb-3">
                <label for="file_foto" class="form-label fw-semibold">Foto</label>
                @if($galeri->file_foto)
                    <div class="mt-2 mb-3"> {{-- Tambahkan mb-3 di sini --}}
                        <img src="{{ asset('img/' . $galeri->file_foto) }}" alt="Foto Galeri" class="img-thumbnail mt-1" style="max-height: 150px;">
                    </div>
                @endif
                <input type="file" class="form-control @error('file_foto') is-invalid @enderror" name="file_foto" id="file_foto">
                @error('file_foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol -->
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
