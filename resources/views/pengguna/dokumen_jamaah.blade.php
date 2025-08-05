@extends('pengguna.layouts.main')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('images/image_home.png') }}'); height: 500px;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 text-center pb-5">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span>
                    <span>Dokumen Saya <i class="fa fa-chevron-right"></i></span>
                </p>
                <h1 class="mb-0 bread">Dokumen Saya</h1>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    @if(session('success'))
    @php
        $alertType = session('alert_type') ?? 'tambah';
        $styles = [
            'tambah' => ['#E0FBFF', '#1AC9E0'],
            'edit'   => ['#FFF5E0', '#FFB703'],
            'hapus'  => ['#FFE0E0', '#F94144'],
        ];
        $bgColor = $styles[$alertType][0] ?? '#f8f9fa';
        $textColor = $styles[$alertType][1] ?? '#000';
    @endphp

    <div class="alert" style="background-color: {{ $bgColor }}; color: {{ $textColor }}; border-left: 6px solid {{ $textColor }}; padding: 16px; margin-bottom: 24px;">
        <strong>{{ session('success') }}</strong>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="fw-bold mb-4 border-bottom pb-2 d-flex justify-content-between align-items-center">
                Dokumen Saya
                <a href="{{ route('jamaah.editDokumenSaya') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>
            </h4>

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Nama Jamaah</th>
                        <td>{{ $jamaah->nama_jamaah }}</td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td>{{ $jamaah->nik }}</td>
                    </tr>
                    <tr>
                        <th>Tempat & Tanggal Lahir</th>
                        <td>{{ $jamaah->tempat_lahir }}, {{ \Carbon\Carbon::parse($jamaah->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Umur</th>
                        <td>{{ $jamaah->umur }} tahun</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $jamaah->alamat }}</td>
                    </tr>
                    <tr>
                        <th>No Telepon</th>
                        <td>{{ $jamaah->no_telepon }}</td>
                    </tr>
                    <tr>
                        <th>Nama Ayah</th>
                        <td>{{ $jamaah->nama_ayah }}</td>
                    </tr>
                    <tr>
                        <th>Pekerjaan</th>
                        <td>{{ $jamaah->pekerjaan }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $jamaah->jenis_kelamin }}</td>
                    </tr>

                    {{-- Dokumen --}}
                    @foreach([
                        'pas_foto' => 'Pas Foto',
                        'file_ktp' => 'KTP',
                        'file_kk' => 'Kartu Keluarga',
                        'file_paspor' => 'Paspor'
                    ] as $field => $label)
                    <tr>
                        <th>{{ $label }}</th>
                        <td>
                            @php
                                $file = $jamaah->$field;
                                $ext = pathinfo($file, PATHINFO_EXTENSION);
                                $isImage = in_array(strtolower($ext), ['jpg','jpeg','png','webp']);
                            @endphp

                            @if ($file)
                                @if ($isImage)
                                    <img src="{{ asset('img/' . $file) }}" class="img-thumbnail" style="height: 120px;">
                                @else
                                    <embed src="{{ asset('img/' . $file) }}" width="100%" height="300px" type="application/pdf"/>
                                @endif
                            @else
                                <span class="text-muted">Belum diunggah</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
