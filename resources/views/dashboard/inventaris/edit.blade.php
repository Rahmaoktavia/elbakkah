@extends('dashboard.layouts.main')

@section('title', 'Edit Inventaris Perlengkapan')
@section('navInventaris', 'active')

@section('content')

<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Edit Inventaris Perlengkapan</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <form action="{{ route('dashboard.inventaris.update', $inventaris->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Perlengkapan -->
            <div class="mb-3">
                <label for="nama_perlengkapan" class="form-label fw-semibold">Nama Perlengkapan</label>
                <input type="text" class="form-control @error('nama_perlengkapan') is-invalid @enderror"
                       name="nama_perlengkapan" id="nama_perlengkapan"
                       placeholder="Masukkan nama perlengkapan"
                       value="{{ old('nama_perlengkapan', $inventaris->nama_perlengkapan) }}">
                @error('nama_perlengkapan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jumlah Total -->
            <div class="mb-3">
                <label for="jumlah_total" class="form-label fw-semibold">Jumlah Total</label>
                <input type="number" class="form-control @error('jumlah_total') is-invalid @enderror"
                       name="jumlah_total" id="jumlah_total"
                       placeholder="Masukkan jumlah total"
                       value="{{ old('jumlah_total', $inventaris->jumlah_total) }}">
                @error('jumlah_total')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jumlah Tersedia -->
            <div class="mb-3">
                <label for="jumlah_tersedia" class="form-label fw-semibold">Jumlah Tersedia</label>
                <input type="number" class="form-control @error('jumlah_tersedia') is-invalid @enderror"
                       name="jumlah_tersedia" id="jumlah_tersedia"
                       placeholder="Masukkan jumlah tersedia"
                       value="{{ old('jumlah_tersedia', $inventaris->jumlah_tersedia) }}">
                @error('jumlah_tersedia')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Satuan -->
            <div class="mb-3">
                <label for="satuan" class="form-label fw-semibold">Satuan</label>
                <select name="satuan" id="satuan"
                        class="form-select @error('satuan') is-invalid @enderror">
                    <option disabled value="">-- Pilih Satuan --</option>
                    <option value="Pcs" {{ old('satuan', $inventaris->satuan) == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                    <option value="Set" {{ old('satuan', $inventaris->satuan) == 'Set' ? 'selected' : '' }}>Set</option>
                    <option value="Paket" {{ old('satuan', $inventaris->satuan) == 'Paket' ? 'selected' : '' }}>Paket</option>
                </select>
                @error('satuan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tanggal Masuk -->
            <div class="mb-4">
                <label for="tanggal_input" class="form-label fw-semibold">Tanggal Masuk</label>
                <input type="date" class="form-control @error('tanggal_input') is-invalid @enderror"
                       name="tanggal_input" id="tanggal_input"
                       value="{{ old('tanggal_input', $inventaris->tanggal_input) }}">
                @error('tanggal_input')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('dashboard.inventaris.index') }}" class="btn btn-secondary d-flex align-items-center">
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
