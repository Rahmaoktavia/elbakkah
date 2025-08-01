@extends('dashboard.layouts.main')

@section('title', 'Edit Paket Umrah')
@section('navPaketUmrah', 'active')

@section('content')

<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Edit Paket Umrah</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <form action="{{ route('dashboard.paket.update', $paket->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama Paket -->
            <div class="mb-3">
                <label for="nama_paket" class="form-label fw-semibold">Nama Paket</label>
                <input type="text" class="form-control @error('nama_paket') is-invalid @enderror"
                       name="nama_paket" id="nama_paket"
                       placeholder="Masukkan nama paket"
                       value="{{ old('nama_paket', $paket->nama_paket) }}">
                @error('nama_paket')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Harga -->
            <div class="mb-3">
                <label for="harga" class="form-label fw-semibold">Harga</label>
                <input type="number" step="0.01" class="form-control @error('harga') is-invalid @enderror"
                       name="harga" id="harga"
                       placeholder="Masukkan harga paket"
                       value="{{ old('harga', $paket->harga) }}">
                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jumlah Hari -->
            <div class="mb-3">
                <label for="jumlah_hari" class="form-label fw-semibold">Jumlah Hari</label>
                <input type="number" class="form-control @error('jumlah_hari') is-invalid @enderror"
                       name="jumlah_hari" id="jumlah_hari"
                       placeholder="Masukkan durasi perjalanan"
                       value="{{ old('jumlah_hari', $paket->jumlah_hari) }}">
                @error('jumlah_hari')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hotel Makkah -->
            <div class="mb-3">
                <label for="hotel_makkah" class="form-label fw-semibold">Hotel di Makkah</label>
                <input type="text" class="form-control @error('hotel_makkah') is-invalid @enderror"
                    name="hotel_makkah" id="hotel_makkah"
                    placeholder="Masukkan nama hotel di Makkah"
                    value="{{ old('hotel_makkah', $paket->hotel_makkah) }}">
                @error('hotel_makkah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hotel Madinah -->
            <div class="mb-3">
                <label for="hotel_madinah" class="form-label fw-semibold">Hotel di Madinah</label>
                <input type="text" class="form-control @error('hotel_madinah') is-invalid @enderror"
                    name="hotel_madinah" id="hotel_madinah"
                    placeholder="Masukkan nama hotel di Madinah"
                    value="{{ old('hotel_madinah', $paket->hotel_madinah) }}">
                @error('hotel_madinah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Fasilitas -->
            <div class="mb-3">
                <label for="fasilitas" class="form-label fw-semibold">Fasilitas</label>
                <textarea class="form-control @error('fasilitas') is-invalid @enderror"
                          name="fasilitas" id="fasilitas" rows="3"
                          placeholder="Masukkan fasilitas yang diberikan">{{ old('fasilitas', $paket->fasilitas) }}</textarea>
                @error('fasilitas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                          name="deskripsi" id="deskripsi" rows="3"
                          placeholder="Masukkan deskripsi tambahan">{{ old('deskripsi', $paket->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Gambar Paket -->
            <div class="mb-3">
                <label for="gambar_paket" class="form-label fw-semibold">Gambar Paket</label>
                @if($paket->gambar_paket)
                    <div class="mt-2 mb-3">
                        <img src="{{ asset('img/' . $paket->gambar_paket) }}" alt="Gambar Paket" class="img-thumbnail mt-1" style="max-height: 150px;">
                    </div>
                @endif
                <input type="file" class="form-control @error('gambar_paket') is-invalid @enderror" name="gambar_paket" id="gambar_paket">
                @error('gambar_paket')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('dashboard.paket.index') }}" class="btn btn-secondary d-flex align-items-center">
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
