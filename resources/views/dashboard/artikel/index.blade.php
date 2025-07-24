@extends('dashboard.layouts.main')

@section('title', 'Daftar Artikel')
@section('navArtikel', 'active')

@section('content')

<!-- Kontainer utama -->
<div class="card shadow-sm">
    <!-- Header Card -->
    <div class="card-header bg-white">
        <!-- Judul Data Artikel -->
        <h4 class="fw-bold text-dark mb-3">Data Artikel</h4>

        <!-- Baris tombol dan pencarian -->
        <div class="d-flex justify-content-between align-items-center">
            <!-- Tombol Tambah -->
            <div class="d-flex">
                <a href="{{ route('dashboard.artikel.create') }}" class="btn btn-biru me-2 d-flex align-items-center">
                    <i class='bx bx-plus'></i>&nbsp;Tambah Artikel
                </a>

                <a href="{{ route('dashboard.artikel.cetak_pdf') }}" target="_blank" class="btn btn-outline-danger d-flex align-items-center justify-content-center">
                    <i class='bx bxs-file-pdf fs-5'></i>
                </a>
            </div>

            <!-- Form Pencarian -->
            <form class="d-flex" method="GET" action="{{ route('dashboard.artikel.index') }}" style="max-width: 300px; width: 100%;">
                <div class="input-group">
                    <input class="form-control" type="search" name="search" value="{{ request()->get('search') }}" placeholder="Cari Artikel..." aria-label="Search">
                    <button class="btn btn-primary" type="submit">
                        <i class='bx bx-search'></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Body Card -->
    <div class="card-body">

        <!-- Notifikasi sukses -->
        @if(session('success'))
        @php
            $alertType = session('alert_type') ?? 'tambah'; // default 'tambah'
            $styles = [
                'tambah' => ['#E0FBFF', '#1AC9E0'], // biru
                'edit'   => ['#FFF5E0', '#FFB703'], // kuning
                'hapus'  => ['#FFE0E0', '#F94144'], // merah
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

        <!-- Tabel Artikel -->
        <table class="table table-striped table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Artikel</th>
                    <th>Gambar Sampul</th>
                    <th>Tanggal Terbit</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($artikels as $artikel)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $artikel->judul_artikel }}</td>
                    <td>
                        <img src="{{ asset('img/' . $artikel->gambar_sampul) }}" alt="{{ $artikel->judul_artikel }}" class="img-thumbnail" width="100">
                    </td>
                    <td>{{ \Carbon\Carbon::parse($artikel->tanggal_terbit)->format('d M Y') }}</td>
                    <td class="text-nowrap text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('dashboard.artikel.show', $artikel->id) }}" class="btn btn-success btn-sm me-1" title="Lihat Detail">
                                <i class='bx bx-show'></i>
                            </a>
                            <a href="{{ route('dashboard.artikel.edit', $artikel->id) }}" class="btn btn-warning btn-sm me-1" title="Edit Data">
                                <i class='bx bx-edit'></i>
                            </a>
                            <form action="{{ route('dashboard.artikel.destroy', $artikel->id) }}" method="POST" class="d-inline form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm btn-delete" title="Hapus Data">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $artikels->appends(request()->query())->links('pagination::bootstrap-4') }}
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
