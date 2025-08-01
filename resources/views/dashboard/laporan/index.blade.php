@extends('dashboard.layouts.main')

@section('content')
<div class="container py-4 d-flex justify-content-center">
    <div class="card shadow-sm border-0 rounded-4 w-100" style="max-width: 800px;">
        <div class="card-header bg-white border-bottom">
            <h4 class="m-0 fw-bold text-dark">Laporan</h4>
        </div>
        <div class="card-body bg-light py-4">

            @php
                $iconStyle = "width: 40px; height: 40px; background: linear-gradient(to bottom right, #00c6ff, #00d9ff); border-radius: 50%; display: flex; align-items: center; justify-content: center;";
                $iconClass = "text-white fs-5";
                $btnWrapper = "d-flex justify-content-end align-items-center";
                $btnClass = "btn btn-primary d-flex align-items-center gap-2";
                $btnIcon = "bi bi-download";
            @endphp

            {{-- PEMBAYARAN --}}
            <div class="d-flex gap-3 align-items-start mb-3 p-3 bg-white rounded shadow-sm">
                <div style="{{ $iconStyle }}">
                    <i class="bi bi-cash-coin {{ $iconClass }}"></i>
                </div>
                <div class="flex-grow-1">
                    <h6 class="fw-semibold mb-2">Laporan Pembayaran</h6>
                    <form action="{{ route('laporan.cetakPembayaran') }}" method="GET" target="_blank" class="row g-2 align-items-end">
                        <div class="col-md-4">
                            <select name="bulan" class="form-select" required>
                                <option value="">Pilih Bulan</option>
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="tahun" class="form-select" required>
                                <option value="">Pilih Tahun</option>
                                @for ($y = now()->year; $y >= 2020; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4 {{ $btnWrapper }}">
                            <button class="{{ $btnClass }}" type="submit">
                                <i class="{{ $btnIcon }}"></i> Unduh PDF
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- PEMESANAN --}}
            <div class="d-flex gap-3 align-items-start mb-3 p-3 bg-white rounded shadow-sm">
                <div style="{{ $iconStyle }}">
                    <i class="bi bi-bag-check {{ $iconClass }}"></i>
                </div>
                <div class="flex-grow-1">
                    <h6 class="fw-semibold mb-2">Laporan Pemesanan</h6>
                    <form action="{{ route('laporan.cetakPemesanan') }}" method="GET" target="_blank" class="row g-2 align-items-end">
                        <div class="col-md-4">
                            <select name="bulan" class="form-select" required>
                                <option value="">Pilih Bulan</option>
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="tahun" class="form-select" required>
                                <option value="">Pilih Tahun</option>
                                @for ($y = now()->year; $y >= 2020; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4 {{ $btnWrapper }}">
                            <button class="{{ $btnClass }}" type="submit">
                                <i class="{{ $btnIcon }}"></i> Unduh PDF
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- LAPORAN LAINNYA --}}
            @php
                $laporanList = [
                    ['icon' => 'people-fill', 'title' => 'Laporan Jamaah', 'route' => 'laporan.cetakJamaah'],
                    ['icon' => 'archive-fill', 'title' => 'Laporan Inventaris Perlengkapan', 'route' => 'laporan.cetakInventaris'],
                    ['icon' => 'truck', 'title' => 'Laporan Distribusi Perlengkapan', 'route' => 'laporan.cetakDistribusi'],
                    ['icon' => 'gift-fill', 'title' => 'Laporan Paket Umrah', 'route' => 'laporan.cetakPaket'],
                    ['icon' => 'calendar-check-fill', 'title' => 'Laporan Jadwal Keberangkatan', 'route' => 'laporan.cetakJadwal'],
                ];
            @endphp

            @foreach ($laporanList as $laporan)
                <div class="d-flex gap-3 align-items-center mb-3 p-3 bg-white rounded shadow-sm">
                    <div style="{{ $iconStyle }}">
                        <i class="bi bi-{{ $laporan['icon'] }} {{ $iconClass }}"></i>
                    </div>
                    <div class="flex-grow-1 d-flex justify-content-between align-items-center">
                        <h6 class="fw-semibold mb-0">{{ $laporan['title'] }}</h6>
                        <a href="{{ route($laporan['route']) }}" class="btn btn-primary d-flex align-items-center gap-2" target="_blank">
                            <i class="bi bi-download"></i> Unduh PDF
                        </a>                        
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>

<style>
.card-body h6 {
    transition: color 0.2s;
}
.card-body h6:hover {
    color: #007bff;
}
</style>
@endsection
