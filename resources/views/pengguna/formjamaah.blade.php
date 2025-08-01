@extends('pengguna.layouts.main')

@section('content')

{{-- Hero Banner --}}
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('images/image_home.png') }}'); height: 500px;">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center" style="height: 500px;">
      <div class="col-md-9 ftco-animate pb-5 text-center">
        <p class="breadcrumbs">
          <span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span>
          <span class="mr-2"><a href="/paket-umrah">Paket Umrah <i class="fa fa-chevron-right"></i></a></span>
          <span>{{ $paketUmrahs->nama_paket }}</span>
        </p>
        <h1 class="mb-2 bread">{{ $paketUmrahs->nama_paket }}</h1>
        <h2 class="text-white fw-bold" style="font-size: 1.5rem;">Formulir Pendaftaran Jamaah</h2>
      </div>
    </div>
  </div>
</section>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">

      {{-- Jika Belum Login --}}
      @guest
        <div class="alert alert-warning text-center shadow-sm p-4">
          <h5 class="text-dark fw-bold mb-3">
            <i class="bi bi-lock-fill me-2"></i>Anda Belum Login
          </h5>
          <p>Silakan <a href="{{ route('login') }}" class="text-primary fw-bold">login</a> atau <a href="{{ route('register') }}" class="text-primary fw-bold">register</a> terlebih dahulu untuk mengisi formulir pendaftaran jamaah.</p>
        </div>
      @endguest

      @auth

      {{-- Alert Sukses --}}
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
        <div class="alert" style="background-color: {{ $bgColor }}; color: {{ $textColor }}; border-left: 5px solid {{ $textColor }}; padding: 15px; margin-bottom: 25px; border-radius: 5px;">
            {{ session('success') }}
        </div>
        @endif

      {{-- Informasi Paket --}}
      <div class="card border-0 mb-5 shadow-lg">
        <div class="card-body">
          <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/' . $paketUmrahs->gambar_paket) }}" class="rounded" width="100" height="80" style="object-fit: cover; margin-right: 12px;" alt="gambar paket">
            <h4 class="fw-bold text-dark mb-0">{{ $paketUmrahs->nama_paket }}</h4>
          </div>
          <hr class="mb-4">

          <div class="row g-3">
            @foreach ([
              ['icon' => 'fa-money', 'label' => 'Harga', 'value' => 'Rp ' . number_format($paketUmrahs->harga, 0, ',', '.')],
              ['icon' => 'fa-calendar', 'label' => 'Durasi', 'value' => $paketUmrahs->jumlah_hari . ' Hari'],
              ['icon' => 'fa-hotel', 'label' => 'Hotel Makkah', 'value' => $paketUmrahs->hotel_makkah],
              ['icon' => 'fa-hotel', 'label' => 'Hotel Madinah', 'value' => $paketUmrahs->hotel_madinah],
              ['icon' => 'fa-plane', 'label' => 'Keberangkatan', 'value' => \Carbon\Carbon::parse($jadwal->tanggal_berangkat)->format('d M Y')],
              ['icon' => 'fa-users', 'label' => 'Kuota', 'value' => $jadwal->kuota . ' jamaah']
            ] as $item)
              <div class="col-md-6 d-flex align-items-start gap-3">
                <div class="d-flex justify-content-center align-items-center rounded-circle" style="background-color: #1AC9E0; color: white; width: 40px; height: 40px; font-size: 16px;">
                  <i class="fa {{ $item['icon'] }}"></i>
                </div>
                <div>
                  <p class="text-muted mb-1">{{ $item['label'] }}</p>
                  <p class="text-dark mb-0">{{ $item['value'] }}</p>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>

      {{-- Formulir Pendaftaran --}}
      <div class="card border-0 shadow-lg">
        <div class="card-header bg-white border-bottom">
          <h5 class="text-dark fw-bold mb-0">Formulir Pendaftaran Jamaah</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('jamaah.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <div class="row g-4">
              @foreach ([
                ['label' => 'Nama Jamaah', 'name' => 'nama_jamaah', 'type' => 'text', 'col' => 6],
                ['label' => 'NIK', 'name' => 'nik', 'type' => 'text', 'col' => 6],
                ['label' => 'Tempat Lahir', 'name' => 'tempat_lahir', 'type' => 'text', 'col' => 6],
                ['label' => 'Tanggal Lahir', 'name' => 'tanggal_lahir', 'type' => 'date', 'col' => 6],
                ['label' => 'Alamat Lengkap', 'name' => 'alamat', 'type' => 'textarea', 'col' => 12],
                ['label' => 'No Telepon', 'name' => 'no_telepon', 'type' => 'text', 'col' => 6],
                ['label' => 'Nama Ayah', 'name' => 'nama_ayah', 'type' => 'text', 'col' => 6],
                ['label' => 'Pekerjaan', 'name' => 'pekerjaan', 'type' => 'text', 'col' => 6],
              ] as $field)
                <div class="col-md-{{ $field['col'] }}">
                  <label class="form-label text-dark">{{ $field['label'] }}</label>
                  @if($field['type'] === 'textarea')
                    <textarea class="form-control" name="{{ $field['name'] }}" rows="2" required></textarea>
                  @else
                    <input type="{{ $field['type'] }}" class="form-control" name="{{ $field['name'] }}" required>
                  @endif
                </div>
              @endforeach

              <div class="col-md-6">
                <label class="form-label text-dark">Jenis Kelamin</label>
                <select class="form-select" name="jenis_kelamin" required>
                  <option value="">-- Pilih --</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>

              {{-- Uploads --}}
              @foreach ([
                ['label' => 'Pas Foto', 'name' => 'pas_foto'],
                ['label' => 'File KTP', 'name' => 'file_ktp'],
                ['label' => 'File KK', 'name' => 'file_kk'],
                ['label' => 'File Paspor', 'name' => 'file_paspor']
              ] as $upload)
                <div class="col-md-6">
                  <label class="form-label text-dark">{{ $upload['label'] }}</label>
                  <input type="file" class="form-control" name="{{ $upload['name'] }}">
                </div>
              @endforeach
            </div>

            <div class="mt-4 text-end">
              <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-2">&larr; Kembali</a>
              <button type="submit" class="btn btn-primary px-4">Konfirmasi Data</button>
            </div>
          </form>
        </div>
      </div>

      {{-- Tombol Pesan --}}
      <div class="mt-4 text-end">
        @if(auth()->user()->jamaah)
          <form action="{{ route('pemesanan.store') }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="keberangkatan_id" value="{{ $jadwal->id }}">
            <button type="submit" class="btn btn-success shadow px-3">
              <i class="fa fa-check-circle me-2"></i>Pesan Sekarang
            </button>
          </form>
        @else
          <span data-bs-toggle="tooltip" data-bs-placement="top" title="Isi data jamaah terlebih dahulu">
            <button type="button" class="btn btn-secondary px-3 shadow" disabled>
              <i class="fa fa-times-circle me-2 text-danger"></i>Pesan Sekarang
            </button>
          </span>
        @endif
      </div>

      @endauth

    </div>
  </div>
</div>

@endsection
