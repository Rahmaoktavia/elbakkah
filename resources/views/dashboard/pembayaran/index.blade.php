@extends('dashboard.layouts.main')

@section('title', 'Daftar Pembayaran')
@section('navPembayaran', 'active')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="fw-bold text-dark mb-3">Data Pembayaran</h4>

        <div class="row align-items-end g-2">
            <!-- Tombol Cetak PDF -->
            <div class="col-md-1">
                <a href="{{ route('dashboard.pembayaran.cetak_pdf', [
                    'bulan' => request('bulan'),
                    'tahun' => request('tahun'),
                    'status_verifikasi' => request('status_verifikasi')
                ]) }}" target="_blank" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center">
                    <i class='bx bxs-file-pdf fs-5'></i>
                </a>
            </div>
        
            <!-- Filter: Bulan -->
            <div class="col-md-2">
                <form method="GET" action="{{ route('dashboard.pembayaran.index') }}" class="d-flex">
                    <select class="form-select me-2" name="bulan" onchange="this.form.submit()">
                        <option value="">-- Pilih Bulan --</option>
                        @foreach(range(1, 12) as $b)
                            <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}
                            </option>
                        @endforeach
                    </select>
            </div>
        
            <!-- Filter: Tahun -->
            <div class="col-md-2">
                    <select class="form-select me-2" name="tahun" onchange="this.form.submit()">
                        <option value="">-- Pilih Tahun --</option>
                        @foreach(range(date('Y'), 2020) as $t)
                            <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
            </div>
        
            <!-- Filter: Status Verifikasi -->
            <div class="col-md-2">
                    <select class="form-select me-2" name="status_verifikasi" onchange="this.form.submit()">
                        <option value="">-- Status --</option>
                        <option value="Diterima" {{ request('status_verifikasi') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="Ditolak" {{ request('status_verifikasi') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="Menunggu" {{ request('status_verifikasi') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    </select>
                </form>
            </div>
        
            <!-- Search -->
            <div class="col-md-4 ms-auto">
                <form class="d-flex" method="GET" action="{{ route('dashboard.pembayaran.index') }}">
                    <div class="input-group">
                        <input class="form-control" type="search" name="search" value="{{ request()->get('search') }}" placeholder="Cari Jamaah..." aria-label="Search">
                        <button class="btn btn-primary" type="submit">
                            <i class='bx bx-search'></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>        
    </div>

    <div class="card-body">
        @if(session('success'))
        @php
            $alertType = session('alert_type') ?? 'tambah';
            $styles = [
                'tambah' => ['#E0FBFF', '#1AC9E0'],
                'edit'   => ['#FFF5E0', '#FFB703'],
                'hapus'  => ['#FFE0E0', '#F94144'],
            ];
            $bgColor = $styles[$alertType][0];
            $textColor = $styles[$alertType][1];
        @endphp

        <div class="alert alert-dismissible fade show d-flex align-items-center" role="alert" style="
            background-color: {{ $bgColor }};
            color: {{ $textColor }};
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 1rem;
            font-weight: 500;
        ">
            <i class='bx bx-check-circle me-2' style="font-size: 1.2rem;"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <table class="table table-striped table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Jamaah</th>
                    <th>Nama Paket</th>
                    <th>Harga Paket</th>
                    <th>Jumlah Bayar</th>
                    <th>Status Verifikasi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayarans as $pembayaran)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pembayaran->pemesanan->jamaah->nama_jamaah ?? '-' }}</td>
                    <td>{{ $pembayaran->pemesanan->jadwalKeberangkatan->paket->nama_paket ?? '-' }}</td>
                    <td>Rp {{ number_format($pembayaran->pemesanan->total_tagihan ?? 0, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-{{ $pembayaran->status_verifikasi === 'Diterima' ? 'success' : ($pembayaran->status_verifikasi === 'Ditolak' ? 'danger' : 'warning') }}">
                            {{ $pembayaran->status_verifikasi }}
                        </span>
                    </td>
                    <td class="text-nowrap text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('dashboard.pembayaran.show', $pembayaran->id) }}" class="btn btn-success btn-sm me-1" title="Lihat Detail">
                                <i class='bx bx-show'></i>
                            </a>
                            <a href="{{ route('dashboard.pembayaran.edit', $pembayaran->id) }}" class="btn btn-warning btn-sm" title="Edit Pembayaran">
                                <i class='bx bx-edit'></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $pembayarans->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
