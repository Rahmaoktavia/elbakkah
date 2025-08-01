@extends('dashboard.layouts.main')

@section('title', 'Daftar Pembayaran')
@section('navPembayaran', 'active')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="fw-bold text-dark mb-3">Data Pembayaran</h4>

        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <a href="{{ route('dashboard.pembayaran.cetak_pdf') }}" target="_blank" class="btn btn-outline-danger d-flex align-items-center justify-content-center">
                    <i class='bx bxs-file-pdf fs-5'></i>
                </a>
            </div>

            <form class="d-flex" method="GET" action="{{ route('dashboard.pembayaran.index') }}" style="max-width: 300px; width: 100%;">
                <div class="input-group">
                    <input class="form-control" type="search" name="search" value="{{ request()->get('search') }}" placeholder="Cari Jamaah..." aria-label="Search">
                    <button class="btn btn-primary" type="submit">
                        <i class='bx bx-search'></i>
                    </button>
                </div>
            </form>
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
                    <td>Rp {{ number_format($pembayaran->pemesanan->jadwalKeberangkatan->paket->harga ?? 0, 0, ',', '.') }}</td>
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
