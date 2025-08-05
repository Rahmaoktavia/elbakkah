@extends('dashboard.layouts.main')

@section('title', 'Daftar Pemesanan')
@section('navPemesanan', 'active')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="fw-bold text-dark mb-3">Data Pemesanan</h4>
    
        <div class="row align-items-end g-2">
            <!-- Tombol Cetak PDF -->
            <div class="col-md-1">
                <a href="{{ route('dashboard.pemesanan.cetak_pdf', [
                    'bulan' => request('bulan'),
                    'tahun' => request('tahun'),
                    'status' => request('status')
                ]) }}" target="_blank" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center">
                    <i class='bx bxs-file-pdf fs-5'></i>
                </a>
            </div>
    
            <!-- Filter: Bulan -->
            <div class="col-md-2">
                <form method="GET" action="{{ route('dashboard.pemesanan.index') }}" class="d-flex">
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
                            <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>
                                {{ $t }}
                            </option>
                        @endforeach
                    </select>
            </div>
    
            <!-- Filter: Status Pembayaran -->
            <div class="col-md-2">
                    <select class="form-select me-2" name="status" onchange="this.form.submit()">
                        <option value="">-- Status --</option>
                        <option value="Lunas" {{ request('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        <option value="Belum Lunas" {{ request('status') == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                    </select>
                </form>
            </div>
    
            <!-- Search Form -->
            <div class="col-md-4 ms-auto">
                <form class="d-flex" method="GET" action="{{ route('dashboard.pemesanan.index') }}">
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
                    <th>Tanggal Pesan</th>
                    <th>Total Tagihan</th>
                    <th>Status Pembayaran</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemesanans as $pemesanan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pemesanan->jamaah->nama_jamaah ?? '-' }}</td>
                    <td>{{ $pemesanan->jadwalKeberangkatan->paket->nama_paket ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal_pesan)->translatedFormat('d F Y') }}</td>
                    <td>Rp {{ number_format($pemesanan->total_tagihan, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-{{ $pemesanan->status_pembayaran === 'Lunas' ? 'success' : 'warning' }}">
                            {{ $pemesanan->status_pembayaran }}
                        </span>
                    </td>
                    <td class="text-nowrap text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('dashboard.pemesanan.show', $pemesanan->id) }}" class="btn btn-success btn-sm me-1" title="Lihat Detail">
                                <i class='bx bx-show'></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $pemesanans->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
