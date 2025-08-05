@extends('pengguna.layouts.main')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('images/image_home.png') }}'); height: 500px;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs">
                  <span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span>
                  <span class="mr-2"><a href="/dokumen-saya">Dokumen Saya <i class="fa fa-chevron-right"></i></a></span>
                  <span>Edit Dokumen Saya <i class="fa fa-chevron-right"></i></span>
                </p>
                <h1 class="mb-0 bread">Edit Dokumen Saya</h1>
              </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="fw-bold mb-4 border-bottom pb-2">
                Edit Dokumen Saya
            </h4>

            <form action="{{ route('jamaah.updateDokumenSaya') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        @foreach ([
                            'nama_jamaah' => 'Nama Jamaah',
                            'nik' => 'NIK',
                            'tempat_lahir' => 'Tempat Lahir',
                            'tanggal_lahir' => 'Tanggal Lahir',
                            'alamat' => 'Alamat',
                            'no_telepon' => 'No Telepon',
                            'nama_ayah' => 'Nama Ayah',
                            'pekerjaan' => 'Pekerjaan'
                        ] as $field => $label)
                            <div class="mb-3">
                                <label class="form-label">{{ $label }}</label>
                                <input type="{{ $field == 'tanggal_lahir' ? 'date' : 'text' }}"
                                       name="{{ $field }}"
                                       class="form-control @error($field) is-invalid @enderror"
                                       value="{{ old($field, $jamaah->$field) }}" required>
                                @error($field) <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        @endforeach
                        <div class="mb-3">
                            <label class="form-label">Umur</label>
                            <input type="text" class="form-control" value="{{ $jamaah->umur }} tahun" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $jamaah->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $jamaah->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- Dokumen --}}
                    <div class="col-md-6">
                        @foreach ([
                            'pas_foto' => 'Pas Foto',
                            'file_ktp' => 'KTP',
                            'file_kk' => 'Kartu Keluarga',
                            'file_paspor' => 'Paspor'
                        ] as $field => $label)
                            <div class="mb-4">
                                <label class="form-label">{{ $label }}</label><br>

                                @php
                                    $file = $jamaah->$field;
                                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                                    $isImage = in_array(strtolower($ext), ['jpg','jpeg','png']);
                                @endphp

                                @if ($file)
                                    @if ($isImage)
                                        <img src="{{ asset('img/' . $file) }}" class="img-thumbnail mb-2" style="height: 120px;">
                                    @else
                                        <embed src="{{ asset('img/' . $file) }}" type="application/pdf" width="100%" height="150px" class="mb-2"/>
                                    @endif
                                @endif

                                <input type="file" name="{{ $field }}" class="form-control @error($field) is-invalid @enderror" accept="image/*,application/pdf">
                                @error($field) <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('jamaah.dokumenSaya') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
