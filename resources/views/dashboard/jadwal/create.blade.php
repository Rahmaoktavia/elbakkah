@extends('dashboard.layouts.main')

@section('title', 'Tambah Jadwal Keberangkatan')
@section('navJadwal', 'active')

@section('content')

<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Tambah Jadwal Keberangkatan</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <form action="{{ route('dashboard.jadwal.store') }}" method="POST">
            @csrf

            <!-- Paket Umrah -->
            <div class="mb-3">
                <label for="paket_id" class="form-label fw-semibold">Paket Umrah</label>
                <select class="form-select @error('paket_id') is-invalid @enderror" name="paket_id" id="paket_id">
                    <option value="">-- Pilih Paket Umrah --</option>
                    @foreach($paketUmrahs as $paket)
                        <option value="{{ $paket->id }}" {{ old('paket_id') == $paket->id ? 'selected' : '' }}>
                            {{ $paket->nama_paket }}
                        </option>
                    @endforeach
                </select>
                @error('paket_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tanggal Berangkat -->
            <div class="mb-3">
                <label for="tanggal_berangkat" class="form-label fw-semibold">Tanggal Keberangkatan</label>
                <input type="date" class="form-control @error('tanggal_berangkat') is-invalid @enderror"
                       name="tanggal_berangkat" id="tanggal_berangkat" value="{{ old('tanggal_berangkat') }}">
                @error('tanggal_berangkat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Kuota -->
            <div class="mb-4">
                <label for="kuota" class="form-label fw-semibold">Kuota Jamaah</label>
                <input type="number" class="form-control @error('kuota') is-invalid @enderror"
                       name="kuota" id="kuota" placeholder="Masukkan total kuota jamaah" value="{{ old('kuota') }}">
                @error('kuota')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('dashboard.jadwal.index') }}" class="btn btn-secondary d-flex align-items-center">
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
