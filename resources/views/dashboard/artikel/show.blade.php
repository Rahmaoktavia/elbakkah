@extends('dashboard.layouts.main')

@section('title', 'Detail Artikel')
@section('navArtikel', 'active')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h4 class="text-dark fw-bold mb-0">Detail Artikel</h4>
    </div>

    <div class="card-body bg-light">
        {{-- Informasi Utama --}}
        <div class="row mb-4 gx-5">
            <!-- Judul Artikel -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Judul Artikel</label>
                <div class="text-secondary border-bottom pb-1">{{ $artikel->judul_artikel }}</div>
            </div>

            <!-- Tanggal Terbit -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Tanggal Terbit</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ \Carbon\Carbon::parse($artikel->tanggal_terbit)->format('d-m-Y') }}
                </div>
            </div>

            <!-- Isi Artikel -->
            <div class="col-md-12 mb-4">
                <label class="fw-bold text-dark">Isi Artikel</label>
                <div class="text-secondary border-bottom pb-2">
                    {!! $artikel->isi_artikel !!}
                </div>
            </div>
        </div>

        {{-- Gambar Sampul --}}
        <div class="text-center mb-4">
            <label class="fw-bold text-dark d-block mb-3 fs-5">Gambar Sampul</label>
            @if ($artikel->gambar_sampul)
                <div class="card mx-auto shadow-sm border-0 p-4" style="max-width: 600px; background-color: #ffffff;">
                    <img src="{{ asset('img/' . $artikel->gambar_sampul) }}"
                         alt="Gambar Sampul"
                         class="img-fluid rounded"
                         style="max-height: 400px; object-fit: cover; width: 100%;">
                </div>
            @else
                <p class="text-secondary">Tidak ada gambar sampul.</p>
            @endif
        </div>

        {{-- Tombol Kembali --}}
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('dashboard.artikel.index') }}" class="btn btn-secondary px-4 py-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
