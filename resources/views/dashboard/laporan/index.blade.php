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
                        <div class="col-md-3">
                            <select name="bulan" class="form-select">
                                <option value="">Semua Bulan</option> 
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                                @endfor
                            </select>                            
                        </div>
                        <div class="col-md-3">
                            <select name="tahun" class="form-select">
                                <option value="">Semua Tahun</option> 
                                @for ($y = now()->year; $y >= 2020; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="Menunggu">Menunggu</option>
                                <option value="Diterima">Diterima</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex justify-content-end align-items-center">
                            <button class="btn btn-primary d-flex align-items-center gap-2" type="submit">
                                <i class="bi bi-download"></i> Unduh PDF
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
                        <div class="col-md-3">
                            <select name="bulan" class="form-select">
                                <option value="">Semua Bulan</option> 
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                                @endfor
                            </select>     
                        </div>
                        <div class="col-md-3">
                            <select name="tahun" class="form-select">
                                <option value="">Semua Tahun</option> 
                                @for ($y = now()->year; $y >= 2020; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="status_pembayaran" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="Lunas">Lunas</option>
                                <option value="Belum Lunas">Belum Lunas</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex justify-content-end align-items-center">
                            <button class="btn btn-primary d-flex align-items-center gap-2" type="submit">
                                <i class="bi bi-download"></i> Unduh PDF
                            </button>
                        </div>
                    </form>                    
                </div>
            </div>

            {{-- JADWAL KEBERANGKATAN --}}
            <div class="d-flex gap-3 align-items-start mb-3 p-3 bg-white rounded shadow-sm">
                <div style="{{ $iconStyle }}">
                    <i class="bi bi-calendar-check {{ $iconClass }}"></i>
                </div>
                <div class="flex-grow-1">
                    <h6 class="fw-semibold mb-2">Laporan Jadwal Keberangkatan</h6>
                    <form action="{{ route('laporan.cetakJadwal') }}" method="GET" target="_blank" class="row g-2 align-items-end">
                        <div class="col-md-3">
                            <select name="bulan" class="form-select">
                                <option value="">Semua Bulan</option>
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="tahun" class="form-select">
                                <option value="">Semua Tahun</option>
                                @for ($y = now()->year; $y >= 2020; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="nama_paket" class="form-select">
                                <option value="">Semua Paket</option>
                                @foreach ($namaPaketList as $nama)
                                    <option value="{{ $nama }}">{{ $nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex justify-content-end align-items-center">
                            <button class="btn btn-primary d-flex align-items-center gap-2" type="submit">
                                <i class="bi bi-download"></i> Unduh PDF
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- INVENTARIS --}}
            <div class="d-flex gap-3 align-items-start mb-3 p-3 bg-white rounded shadow-sm">
                <div style="{{ $iconStyle }}">
                    <i class="bi bi-archive-fill {{ $iconClass }}"></i>
                </div>
                <div class="flex-grow-1">
                    <h6 class="fw-semibold mb-2">Laporan Inventaris Perlengkapan</h6>
                    <form action="{{ route('laporan.cetakInventaris') }}" method="GET" target="_blank" class="row g-2 align-items-end">
                        <div class="col-md-3">
                            <select name="bulan" class="form-select">
                                <option value="">Semua Bulan</option>
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="tahun" class="form-select">
                                <option value="">Semua Tahun</option>
                                @for ($y = now()->year; $y >= 2020; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>                        
                        <div class="col-md-3">
                            <select name="nama_perlengkapan" class="form-select">
                                <option value="">Semua Perlengkapan</option>
                                @foreach ($namaPerlengkapanList as $nama)
                                    <option value="{{ $nama }}">{{ $nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex justify-content-end align-items-center">
                            <button class="btn btn-primary d-flex align-items-center gap-2" type="submit">
                                <i class="bi bi-download"></i> Unduh PDF
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- DISTRIBUSI PERLENGKAPAN --}}
            <div class="d-flex gap-3 align-items-start mb-3 p-3 bg-white rounded shadow-sm">
                <div style="{{ $iconStyle }}">
                    <i class="bi bi-truck {{ $iconClass }}"></i>
                </div>
                <div class="flex-grow-1">
                    <h6 class="fw-semibold mb-2">Laporan Distribusi Perlengkapan</h6>
                    <form action="{{ route('laporan.cetakDistribusi') }}" method="GET" target="_blank" class="row g-2 align-items-end">
                        <div class="col-md-4">
                            <select name="bulan" class="form-select">
                                <option value="">Semua Bulan</option>
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="tahun" class="form-select">
                                <option value="">Semua Tahun</option>
                                @for ($y = now()->year; $y >= 2020; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end align-items-center">
                            <button class="btn btn-primary d-flex align-items-center gap-2" type="submit">
                                <i class="bi bi-download"></i> Unduh PDF
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- JAMA'AH --}}
            <div class="d-flex gap-3 align-items-start mb-3 p-3 bg-white rounded shadow-sm">
                <div style="{{ $iconStyle }}">
                    <i class="bi bi-people-fill {{ $iconClass }}"></i>
                </div>
                <div class="flex-grow-1">
                    <h6 class="fw-semibold mb-2">Laporan Jamaah</h6>
                    <form action="{{ route('laporan.cetakJamaah') }}" method="GET" target="_blank" class="row g-2 align-items-end">
                        <div class="col-md-4">
                            <select name="jenis_kelamin" class="form-select">
                                <option value="">Semua Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="tahun" class="form-select">
                                <option value="">Semua Tahun</option>
                                @for ($y = now()->year; $y >= 2020; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end align-items-center">
                            <button class="btn btn-primary d-flex align-items-center gap-2" type="submit">
                                <i class="bi bi-download"></i> Unduh PDF
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- LAPORAN LAINNYA --}}
            @php
                $laporanList = [
                    ['icon' => 'gift-fill', 'title' => 'Laporan Paket Umrah', 'route' => 'laporan.cetakPaket'],
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
