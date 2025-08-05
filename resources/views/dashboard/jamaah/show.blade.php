@extends('dashboard.layouts.main')

@section('title', 'Detail Jamaah')
@section('navJamaah', 'active')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h4 class="text-dark fw-bold mb-0">Detail Jamaah</h4>
    </div>

    <div class="card-body bg-light">
        {{-- Informasi Utama --}}
        <div class="row mb-4 gx-5">
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Nama Jamaah</label>
                <div class="text-secondary border-bottom pb-1">{{ $jamaah->nama_jamaah }}</div>
            </div>
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">NIK</label>
                <div class="text-secondary border-bottom pb-1">{{ $jamaah->nik }}</div>
            </div>
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Tempat & Tanggal Lahir</label>
                <div class="text-secondary border-bottom pb-1">{{ $jamaah->tempat_lahir }}, {{ \Carbon\Carbon::parse($jamaah->tanggal_lahir)->translatedFormat('d F Y') }}</div>
            </div>
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Umur</label>
                <div class="text-secondary border-bottom pb-1">{{ $jamaah->umur }} tahun</div>
            </div>
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Jenis Kelamin</label>
                <div class="text-secondary border-bottom pb-1">{{ $jamaah->jenis_kelamin }}</div>
            </div>
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Nomor Telepon</label>
                <div class="text-secondary border-bottom pb-1">{{ $jamaah->no_telepon }}</div>
            </div>
            <div class="col-md-12 mb-4">
                <label class="fw-bold text-dark">Alamat</label>
                <div class="text-secondary border-bottom pb-2">{{ $jamaah->alamat }}</div>
            </div>
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Nama Ayah</label>
                <div class="text-secondary border-bottom pb-1">{{ $jamaah->nama_ayah }}</div>
            </div>
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Pekerjaan</label>
                <div class="text-secondary border-bottom pb-1">{{ $jamaah->pekerjaan }}</div>
            </div>
        </div>

        {{-- Dokumen Upload dengan Preview Tengah --}}
        <hr>
        <h5 class="text-center fw-bold mb-4">Dokumen Jamaah</h5>

        <div class="row justify-content-center">
            @php
                $docs = [
                    'pas_foto' => 'Pas Foto',
                    'file_ktp' => 'File KTP',
                    'file_kk' => 'File KK',
                    'file_paspor' => 'File Paspor',
                ];
            @endphp

            @foreach ($docs as $field => $label)
                <div class="col-md-8 mb-5 text-center">
                    <label class="fw-bold text-dark d-block mb-2">{{ $label }}</label>
                    @if ($jamaah->$field)
                        @php
                            $fileUrl = asset('img/' . $jamaah->$field);
                            $extension = pathinfo($fileUrl, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                            {{-- Tampilkan gambar --}}
                            <div class="card shadow-sm border-0 p-3 bg-white mx-auto" style="max-width: 100%; max-height: 450px;">
                                <img src="{{ $fileUrl }}" class="img-fluid rounded" style="object-fit: contain; max-height: 400px;">
                            </div>
                        @elseif ($extension === 'pdf')
                            {{-- Tampilkan PDF dalam iframe --}}
                            <div class="ratio ratio-4x3 shadow-sm">
                                <iframe src="{{ $fileUrl }}" frameborder="0" class="rounded" allowfullscreen></iframe>
                            </div>
                        @else
                            {{-- File lainnya --}}
                            <a href="{{ $fileUrl }}" target="_blank" class="btn btn-outline-primary btn-sm mt-2">
                                Lihat {{ $label }}
                            </a>
                        @endif
                    @else
                        <div class="text-secondary">Tidak tersedia</div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Tombol Kembali --}}
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('dashboard.jamaah.index') }}" class="btn btn-secondary px-4 py-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
