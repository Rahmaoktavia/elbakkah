@extends('pengguna.layouts.main')

@section('content')

{{-- HERO --}}
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('images/image_home.png') }}'); height: 500px;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center" style="height: 923px;">
            <div class="col-md-9 text-center pb-5">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span>
                    <span>Riwayat Reservasi <i class="fa fa-chevron-right"></i></span>
                </p>
                <h1 class="mb-0 bread">Riwayat Reservasi</h1>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">

    {{-- DETAIL PEMESANAN --}}
    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <h4 class="fw-bold mb-4 border-bottom pb-2">Detail Pemesanan</h4>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nama Jamaah:</strong> {{ $pemesanan->jamaah->nama_jamaah }}</p>
                    <p><strong>Nama Paket:</strong> {{ $pemesanan->jadwalKeberangkatan->paket->nama_paket }}</p>
                    <p><strong>Tanggal Keberangkatan:</strong> {{ \Carbon\Carbon::parse($pemesanan->jadwalKeberangkatan->tanggal_berangkat)->format('d-m-Y') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Total Harga:</strong> Rp {{ number_format($pemesanan->total_tagihan, 0, ',', '.') }}</p>
                    <p><strong>Status Pembayaran:</strong>
                        <span class="badge bg-{{ $pemesanan->status_pembayaran == 'Lunas' ? 'success' : 'warning' }}">
                            {{ $pemesanan->status_pembayaran }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- PROGRESS PEMBAYARAN --}}
    @php
        $totalDibayar = $pemesanan->pembayarans->where('status_verifikasi', 'Diterima')->sum('jumlah_bayar');
        $persentase = min(100, round(($totalDibayar / $pemesanan->total_tagihan) * 100));
    @endphp
    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <h4 class="fw-bold mb-4 border-bottom pb-2">Progress Pembayaran</h4>
            <div class="mb-2">Pembayaran: <strong>{{ $persentase }}%</strong></div>
            <div class="progress mb-2" style="height: 25px;">
                <div class="progress-bar bg-success" style="width: {{ $persentase }}%;">
                    {{ $persentase }}%
                </div>
            </div>
            <small class="text-muted">Sudah dibayar: Rp {{ number_format($totalDibayar, 0, ',', '.') }} dari Rp {{ number_format($pemesanan->total_tagihan, 0, ',', '.') }}</small>
        </div>
    </div>

    {{-- HISTORI PEMBAYARAN --}}
    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <h4 class="fw-bold mb-4 border-bottom pb-2">Histori Pembayaran</h4>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Bayar</th>
                            <th>Jumlah Bayar</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th>Invoice</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pemesanan->pembayarans as $index => $bayar)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($bayar->tanggal_bayar)->format('d-m-Y') }}</td>
                                <td>Rp {{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</td>
                                <td>
                                    @if ($bayar->bukti_transfer)
                                        <a href="{{ asset($bayar->bukti_transfer) }}" target="_blank">Lihat</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $bayar->status_verifikasi == 'Diterima' ? 'success' : ($bayar->status_verifikasi == 'Ditolak' ? 'danger' : 'secondary') }}">
                                        {{ $bayar->status_verifikasi }}
                                    </span>
                                </td>
                                <td>
                                    @if ($bayar->status_verifikasi == 'Diterima')
                                        <a href="{{ route('pembayaran.invoice', $bayar->id) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            Cetak
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada pembayaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- INFO REKENING BANK --}}
    <div class="card shadow-sm mb-5 border-primary" style="border-left: 5px solid #0d6efd;">
        <div class="card-body bg-light">
            <h4 class="fw-bold text-primary mb-4">
                <i class="bi bi-bank2 me-2"></i>Informasi Pembayaran Resmi
            </h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="p-3 bg-white rounded shadow-sm h-100">
                        <h5 class="fw-semibold text-dark mb-2">
                            <i class="bi bi-credit-card-2-front me-2 text-success"></i>Bank Muamalat
                        </h5>
                        <p class="mb-1"><strong>Kode Bank:</strong> 147</p>
                        <p class="mb-1"><strong>Nama Perusahaan:</strong><br>PT Bakkah Ihsan Mubarakah</p>
                        <p class="mb-0"><strong>No Rekening:</strong> 4210055231</p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="p-3 bg-white rounded shadow-sm h-100">
                        <h5 class="fw-semibold text-dark mb-2">
                            <i class="bi bi-credit-card-2-front me-2 text-danger"></i>BSI (Bank Syariah Indonesia)
                        </h5>
                        <p class="mb-1"><strong>Nama Perusahaan:</strong><br>PT Bakkah Ihsan Mubarakah</p>
                        <p class="mb-0"><strong>No Rekening:</strong> 9991113344</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- FORM PEMBAYARAN --}}
    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <h4 class="fw-bold mb-4 border-bottom pb-2">Tambah Pembayaran</h4>

            @if ($pemesanan->status_pembayaran != 'Lunas')
                <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                            <input type="date" name="tanggal_bayar" class="form-control @error('tanggal_bayar') is-invalid @enderror" required>
                            @error('tanggal_bayar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="jumlah_bayar" class="form-label">Jumlah Bayar</label>
                            <input type="number" name="jumlah_bayar" class="form-control @error('jumlah_bayar') is-invalid @enderror" placeholder="Masukkan Jumlah Pembayaran" required>
                            @error('jumlah_bayar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="bukti_transfer" class="form-label">Bukti Transfer</label>
                            <input type="file" name="bukti_transfer" class="form-control @error('bukti_transfer') is-invalid @enderror" accept="image/*,application/pdf">
                            @error('bukti_transfer') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Kirim Pembayaran</button>
                </form>
            @else
            <div class="alert alert-success text-center">
                Pembayaran Anda sudah <strong>lunas</strong>. Silakan menunggu jadwal keberangkatan. Terima kasih!
            </div>            
            @endif
        </div>
    </div>

</div>
@endsection
