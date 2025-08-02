@extends('pengguna.layouts.main')

@section('content')

{{-- HERO --}}
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('images/image_home.png') }}'); height: 500px;">
    <div class="overlay" style="background-color: rgba(0,0,0,0.5);"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center" style="height: 923px;">
            <div class="col-md-9 text-center pb-5">
                <p class="breadcrumbs text-white">
                    <span class="mr-2"><a href="/" class="text-white">Home <i class="fa fa-chevron-right"></i></a></span>
                    <span>Riwayat Perlengkapan <i class="fa fa-chevron-right"></i></span>
                </p>
                <h1 class="mb-0 bread text-white">Riwayat Perlengkapan</h1>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">

    <div class="card border-0 shadow rounded-4">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-4 d-flex align-items-center text-primary">
                <i class="fa fa-box-open me-2" style="color: #1AC9E0;"></i> Perlengkapan yang Sudah Diterima
            </h4>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center rounded shadow-sm overflow-hidden">
                    <thead class="text-white" style="background-color: #1AC9E0;">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th><i class="fa fa-box"></i> Nama Perlengkapan</th>
                            <th><i class="fa fa-sort-numeric-up"></i> Jumlah</th>
                            <th><i class="fa fa-calendar-day"></i> Tanggal Distribusi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($distribusi as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start ps-3">{{ $item->perlengkapan->nama_perlengkapan }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-success px-3 py-2">{{ $item->jumlah_diberikan }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_distribusi)->translatedFormat('d F Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted text-center py-4">
                                    <i class="fa fa-info-circle me-1"></i> Belum ada perlengkapan yang diterima.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Optional: Pagination --}}
            @if ($distribusi instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="mt-4">
                    {{ $distribusi->links('pagination::bootstrap-5') }}
                </div>
            @endif

        </div>
    </div>

</div>
@endsection
