@extends('dashboard.layouts.main')

@section('title', 'Edit Verifikasi Pembayaran')
@section('navPembayaran', 'active')

@section('content')
<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Edit Verifikasi Pembayaran</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <form action="{{ route('dashboard.pembayaran.updateStatus', $pembayaran->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- Nama Jamaah -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Jamaah</label>
                <input type="text" class="form-control bg-light" value="{{ $pembayaran->pemesanan->jamaah->nama_jamaah }}" readonly>
            </div>

            <!-- Nama Paket -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Paket</label>
                <input type="text" class="form-control bg-light" value="{{ $pembayaran->pemesanan->jadwalKeberangkatan->paket->nama_paket }}" readonly>
            </div>

            <!-- Harga Paket -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Harga Paket</label>
                <input type="text" class="form-control bg-light" value="Rp {{ number_format($pembayaran->pemesanan->total_tagihan, 0, ',', '.') }}" readonly>
            </div>

            <!-- Tanggal Keberangkatan -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Tanggal Keberangkatan</label>
                <input type="text" class="form-control bg-light" value="{{ \Carbon\Carbon::parse($pembayaran->pemesanan->jadwalKeberangkatan->tanggal_berangkat)->translatedFormat('d F Y') }}" readonly>
            </div>

            <!-- Hotel Makkah -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Hotel Makkah</label>
                <input type="text" class="form-control bg-light" 
                    value="{{ $pembayaran->pemesanan->jadwalKeberangkatan->paket->hotel_makkah ?? '-' }}" readonly>
            </div>

            <!-- Hotel Madinah -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Hotel Madinah</label>
                <input type="text" class="form-control bg-light" 
                    value="{{ $pembayaran->pemesanan->jadwalKeberangkatan->paket->hotel_madinah ?? '-' }}" readonly>
            </div>

            <!-- Durasi (Jumlah Hari) -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Durasi (Hari)</label>
                <input type="text" class="form-control bg-light" 
                    value="{{ $pembayaran->pemesanan->jadwalKeberangkatan->paket->jumlah_hari ?? '-' }} Hari" readonly>
            </div>

            <!-- Tanggal Bayar -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Tanggal Pembayaran</label>
                <input type="text" class="form-control bg-light" value="{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->translatedFormat('d F Y') }}" readonly>
            </div>

            <!-- Jumlah Bayar -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Jumlah Pembayaran</label>
                <input type="text" class="form-control bg-light" value="Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}" readonly>
            </div>

            <!-- Bukti Transfer -->
            <div class="mb-4">
                <label class="form-label fw-bold text-dark">Bukti Transfer</label>
                @if ($pembayaran->bukti_transfer)
                    <div class="text-center">
                        <img src="{{ asset($pembayaran->bukti_transfer) }}"
                            alt="Bukti Transfer"
                            class="img-fluid rounded shadow"
                            style="max-height: 400px; object-fit: contain;">
                        <div class="mt-2">
                            <a href="{{ asset($pembayaran->bukti_transfer) }}" 
                                download 
                                class="btn btn-outline-primary btn-sm">
                                 <i class="bx bx-download me-1"></i> Unduh Bukti
                             </a>                             
                        </div>
                    </div>
                @else
                    <p class="text-muted">Tidak ada file.</p>
                @endif
            </div>

            <!-- Status Verifikasi -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Status Verifikasi</label>

                @if (Auth::user()->role === 'Direktur Keuangan')
                    <select name="status_verifikasi" class="form-select @error('status_verifikasi') is-invalid @enderror">
                        <option value="Menunggu" {{ $pembayaran->status_verifikasi === 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Diterima" {{ $pembayaran->status_verifikasi === 'Diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="Ditolak" {{ $pembayaran->status_verifikasi === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                @else
                    <input type="text" class="form-control bg-light" value="{{ $pembayaran->status_verifikasi }}" readonly>
                @endif

                @error('status_verifikasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Catatan -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Catatan</label>
                <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="3">{{ old('catatan', $pembayaran->catatan) }}</textarea>
                @error('catatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('dashboard.pembayaran.index') }}" class="btn btn-secondary d-flex align-items-center">
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
