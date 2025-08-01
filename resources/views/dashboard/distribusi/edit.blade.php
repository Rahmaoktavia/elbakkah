@extends('dashboard.layouts.main')

@section('title', 'Edit Distribusi Perlengkapan')
@section('navDistribusi', 'active')

@section('content')

<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Edit Distribusi Perlengkapan</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <form action="{{ route('dashboard.distribusi.update', $distribusi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Jamaah -->
            <div class="mb-3">
                <label for="jamaah_id" class="form-label fw-semibold">Nama Jamaah</label>
                <select name="jamaah_id" id="jamaah_id" class="form-select @error('jamaah_id') is-invalid @enderror">
                    <option disabled value="">-- Pilih Jamaah --</option>
                    @foreach($jamaahs as $jamaah)
                        <option value="{{ $jamaah->id }}"
                            {{ old('jamaah_id', $distribusi->jamaah_id) == $jamaah->id ? 'selected' : '' }}>
                            {{ $jamaah->nama_jamaah }}
                        </option>
                    @endforeach
                </select>
                @error('jamaah_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nama Perlengkapan -->
            <div class="mb-3">
                <label for="perlengkapan_id" class="form-label fw-semibold">Nama Perlengkapan</label>
                <select name="perlengkapan_id" id="perlengkapan_id" class="form-select @error('perlengkapan_id') is-invalid @enderror">
                    <option disabled value="">-- Pilih Perlengkapan --</option>
                    @foreach($perlengkapans as $item)
                        <option value="{{ $item->id }}"
                            {{ old('perlengkapan_id', $distribusi->perlengkapan_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_perlengkapan }}
                        </option>
                    @endforeach
                </select>
                @error('perlengkapan_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jumlah Diberikan -->
            <div class="mb-3">
                <label for="jumlah_diberikan" class="form-label fw-semibold">Jumlah Diberikan</label>
                <input type="number" class="form-control @error('jumlah_diberikan') is-invalid @enderror"
                       name="jumlah_diberikan" id="jumlah_diberikan"
                       placeholder="Masukkan jumlah yang diberikan"
                       value="{{ old('jumlah_diberikan', $distribusi->jumlah_diberikan) }}">
                @error('jumlah_diberikan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tanggal Distribusi -->
            <div class="mb-4">
                <label for="tanggal_distribusi" class="form-label fw-semibold">Tanggal Distribusi</label>
                <input type="date" class="form-control @error('tanggal_distribusi') is-invalid @enderror"
                       name="tanggal_distribusi" id="tanggal_distribusi"
                       value="{{ old('tanggal_distribusi', $distribusi->tanggal_distribusi) }}">
                @error('tanggal_distribusi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('dashboard.distribusi.index') }}" class="btn btn-secondary d-flex align-items-center">
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
