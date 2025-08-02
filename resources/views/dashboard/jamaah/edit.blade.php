@extends('dashboard.layouts.main')

@section('title', 'Edit Data Jamaah')
@section('navJamaah', 'active')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h4 class="text-dark fw-bold mb-0">Edit Dokumen Jamaah</h4>
    </div>

    <div class="card-body bg-light">
        <form action="{{ route('dashboard.jamaah.update', $jamaah->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="user_id" value="{{ $jamaah->user_id }}">

            {{-- Informasi Jamaah --}}
            <div class="row mb-4 gx-5">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-dark">Nama Jamaah</label>
                    <input type="text" class="form-control" value="{{ $jamaah->nama_jamaah }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-dark">NIK</label>
                    <input type="text" class="form-control" value="{{ $jamaah->nik }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-dark">Tempat Lahir</label>
                    <input type="text" class="form-control" value="{{ $jamaah->tempat_lahir }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-dark">Tanggal Lahir</label>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($jamaah->tanggal_lahir)->translatedFormat('d F Y') }}" readonly>
                  </div>                  

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-dark">Jenis Kelamin</label>
                    <input type="text" class="form-control" value="{{ $jamaah->jenis_kelamin }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-dark">Nomor Telepon</label>
                    <input type="text" class="form-control" value="{{ $jamaah->no_telepon }}" readonly>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold text-dark">Alamat</label>
                    <textarea class="form-control" rows="2" readonly>{{ $jamaah->alamat }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-dark">Nama Ayah</label>
                    <input type="text" class="form-control" value="{{ $jamaah->nama_ayah }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-dark">Pekerjaan</label>
                    <input type="text" class="form-control" value="{{ $jamaah->pekerjaan }}" readonly>
                </div>
            </div>

            {{-- Dokumen Upload dengan Preview --}}
            <hr>
            <h5 class="text-center fw-bold mb-4">Edit Dokumen Jamaah</h5>

            @php
                $fields = [
                    'pas_foto' => 'Pas Foto',
                    'file_ktp' => 'File KTP',
                    'file_kk' => 'File KK',
                    'file_paspor' => 'File Paspor',
                ];
            @endphp

            <div class="row justify-content-center">
                @foreach ($fields as $field => $label)
                    <div class="col-md-8 mb-4 text-center">
                        <label for="{{ $field }}" class="form-label fw-bold text-dark d-block mb-2">{{ $label }}</label>

                        @if($jamaah->$field)
                            @php
                                $fileUrl = asset('img/' . $jamaah->$field);
                                $extension = pathinfo($fileUrl, PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                                <div class="card shadow-sm border-0 p-3 bg-white mx-auto mb-2" style="max-width: 100%; max-height: 400px;">
                                    <img src="{{ $fileUrl }}" class="img-fluid rounded" style="object-fit: contain; max-height: 350px;">
                                </div>
                            @elseif ($extension === 'pdf')
                                <div class="ratio ratio-4x3 shadow-sm mb-2">
                                    <iframe src="{{ $fileUrl }}" class="rounded" allowfullscreen></iframe>
                                </div>
                            @else
                                <a href="{{ $fileUrl }}" target="_blank" class="btn btn-outline-primary btn-sm mb-2">Lihat File</a>
                            @endif
                        @else
                            <div class="text-secondary mb-2">File belum diunggah</div>
                        @endif

                        <input type="file" class="form-control @error($field) is-invalid @enderror mt-2" name="{{ $field }}" id="{{ $field }}">
                        @error($field)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('dashboard.jamaah.index') }}" class="btn btn-secondary me-2 px-4 py-2">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-biru d-flex align-items-center">
                    <i class="bx bx-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
