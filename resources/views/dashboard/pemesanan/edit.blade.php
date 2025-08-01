@extends('dashboard.layouts.main')

@section('title', 'Edit Data Jamaah')
@section('navJamaah', 'active')

@section('content')
<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Edit Dokumen Jamaah</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <form action="{{ route('dashboard.jamaah.update', $jamaah->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- User -->
            <div class="mb-3">
                <label class="form-label fw-semibold">User</label>
                <input type="text" class="form-control" value="{{ $jamaah->user->name }}" disabled>
                <input type="hidden" name="user_id" value="{{ $jamaah->user_id }}">
            </div>

            <!-- NIK -->
            <div class="mb-3">
                <label class="form-label fw-semibold">NIK</label>
                <input type="text" class="form-control" value="{{ $jamaah->nik }}" readonly>
            </div>

            <!-- Tempat, Tanggal Lahir -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tempat Lahir</label>
                    <input type="text" class="form-control" value="{{ $jamaah->tempat_lahir }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Lahir</label>
                    <input type="text" class="form-control" value="{{ $jamaah->tanggal_lahir }}" readonly>
                </div>
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Jenis Kelamin</label>
                <input type="text" class="form-control" value="{{ $jamaah->jenis_kelamin }}" readonly>
            </div>

            <!-- No Telepon -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Nomor Telepon</label>
                <input type="text" class="form-control" value="{{ $jamaah->no_telepon }}" readonly>
            </div>

            <!-- Alamat -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Alamat</label>
                <textarea class="form-control" rows="2" readonly>{{ $jamaah->alamat }}</textarea>
            </div>

            <!-- Nama Ayah -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Ayah</label>
                <input type="text" class="form-control" value="{{ $jamaah->nama_ayah }}" readonly>
            </div>

            <!-- Pekerjaan -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Pekerjaan</label>
                <input type="text" class="form-control" value="{{ $jamaah->pekerjaan }}" readonly>
            </div>

            <!-- Dokumen Upload -->
            @php
                $fields = [
                    'pas_foto' => 'Pas Foto',
                    'file_ktp' => 'File KTP',
                    'file_kk' => 'File KK',
                    'file_paspor' => 'File Paspor',
                ];
            @endphp

            @foreach ($fields as $field => $label)
                <div class="mb-3">
                    <label for="{{ $field }}" class="form-label fw-semibold">{{ $label }}</label>
                    @if($jamaah->$field)
                        <p class="text-muted">File sebelumnya: <span class="text-primary">{{ $jamaah->$field }}</span></p>
                    @endif
                    <input type="file" class="form-control @error($field) is-invalid @enderror" name="{{ $field }}" id="{{ $field }}">
                    @error($field)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach

            <!-- Tombol -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('dashboard.jamaah.index') }}" class="btn btn-secondary d-flex align-items-center">
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
