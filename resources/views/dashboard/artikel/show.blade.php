@extends('dashboard.layouts.main')

@section('title', 'Detail Artikel')
@section('navArtikel', 'active')

@section('content')

<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Detail Artikel</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <!-- Judul Artikel -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Judul Artikel</label>
            <div class="form-control bg-light">{{ $artikel->judul_artikel }}</div>
        </div>

        <!-- Tanggal Terbit -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Tanggal Terbit</label>
            <div class="form-control bg-light">
                {{ \Carbon\Carbon::parse($artikel->tanggal_terbit)->format('d-m-Y') }}
            </div>
        </div>

        <!-- Isi Artikel -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Isi Artikel</label>
            <div class="form-control bg-light" style="min-height: 100px;">
                {!! $artikel->isi_artikel !!}
            </div>
        </div>

        <!-- Gambar Sampul -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Gambar Sampul</label><br>
            @if ($artikel->gambar_sampul)
                <img src="{{ asset('img/' . $artikel->gambar_sampul) }}" alt="Gambar Sampul" class="img-thumbnail mt-2" style="max-height: 250px;">
            @else
                <div class="form-control bg-light">Tidak ada gambar sampul.</div>
            @endif
        </div>

        <!-- Tombol -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('dashboard.artikel.index') }}" class="btn btn-secondary d-flex align-items-center">
                <i class="bx bx-arrow-back me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>

@endsection
