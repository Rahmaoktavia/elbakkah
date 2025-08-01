@extends('dashboard.layouts.main')

@section('title', 'Detail Pembayaran')
@section('navPembayaran', 'active')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h4 class="text-dark fw-bold mb-0">Detail Pembayaran</h4>
    </div>

    <div class="card-body bg-light">
        <div class="row mb-4 gx-5">
            <!-- Nama Jamaah -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Nama Jamaah</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ $pembayaran->pemesanan->jamaah->nama_jamaah ?? '-' }}
                </div>
            </div>

            <!-- Nama Paket -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Nama Paket</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ $pembayaran->pemesanan->jadwalKeberangkatan->paket->nama_paket ?? '-' }}
                </div>
            </div>

            <!-- Harga Paket -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Harga Paket</label>
                <div class="text-secondary border-bottom pb-1">
                    Rp {{ number_format($pembayaran->pemesanan->jadwalKeberangkatan->paket->harga ?? 0, 0, ',', '.') }}
                </div>
            </div>

            <!-- Tanggal Keberangkatan -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Tanggal Keberangkatan</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ \Carbon\Carbon::parse($pembayaran->pemesanan->jadwalKeberangkatan->tanggal_berangkat)->translatedFormat('d F Y') }}
                </div>
            </div>

            <!-- Tanggal Pembayaran -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Tanggal Pembayaran</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->translatedFormat('d F Y') }}
                </div>
            </div>

            <!-- Jumlah Bayar -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Jumlah Bayar</label>
                <div class="text-secondary border-bottom pb-1">
                    Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}
                </div>
            </div>

            <!-- Status Verifikasi -->
            <div class="col-md-6 mb-4">
                <label class="fw-bold text-dark">Status Verifikasi</label>
                <div class="text-secondary border-bottom pb-1">
                    <span class="badge 
                        @if($pembayaran->status_verifikasi == 'Diterima') bg-success
                        @elseif($pembayaran->status_verifikasi == 'Ditolak') bg-danger
                        @else bg-warning text-dark
                        @endif">
                        {{ $pembayaran->status_verifikasi }}
                    </span>
                </div>
            </div>

            <!-- Catatan -->
            @if ($pembayaran->catatan)
            <div class="col-md-12 mb-4">
                <label class="fw-bold text-dark">Catatan</label>
                <div class="text-secondary border-bottom pb-1">
                    {{ $pembayaran->catatan }}
                </div>
            </div>
            @endif

            <!-- Bukti Transfer -->
            <div class="col-md-12 mb-4">
                <label class="fw-bold text-dark">Bukti Transfer</label>
                @if ($pembayaran->bukti_transfer)
                    <div class="text-center">
                        <img src="{{ asset($pembayaran->bukti_transfer) }}"
                             alt="Bukti Transfer"
                             class="img-fluid rounded shadow"
                             style="max-height: 400px; object-fit: contain;">
                        <div class="mt-2">
                            <a href="{{ asset($pembayaran->bukti_transfer) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="bx bx-download me-1"></i> Unduh Bukti
                            </a>
                        </div>
                    </div>
                @else
                    <p class="text-muted">Tidak ada file.</p>
                @endif
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('dashboard.pembayaran.index') }}" class="btn btn-secondary px-4 py-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
