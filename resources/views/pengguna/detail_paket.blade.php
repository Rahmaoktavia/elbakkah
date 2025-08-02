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
        <h1 class="mb-0 bread">{{ $paketUmrahs->nama_paket }}</h1>
      </div>
    </div>
  </div>
</section>

<style>
  .icon-circle2 {
    width: 44px;
    height: 44px;
    background-color: #1AC9E0;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 18px;
  }

  .info-item {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    gap: 15px;
  }

  .info-item .text-muted {
    font-size: 0.9rem;
    margin-bottom: 4px;
  }

  .info-item .text-dark {
    font-weight: 600;
    font-size: 1rem;
  }

  .custom-card {
    border-radius: 14px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.06);
    border: none;
    background: #fff;
    padding: 24px;
  }

  .section-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #343a40;
    margin-bottom: 1rem;
    border-bottom: 2px solid #eee;
    padding-bottom: 6px;
  }

  .btn-reservasi {
    border-radius: 30px;
    font-weight: 600;
  }

  .other-paket-item {
    padding: 12px 0;
    border-bottom: 1px solid #eee;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .other-paket-item img {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
  }

  .other-paket-item:last-child {
    border-bottom: none;
  }

  .btn-wa {
    background-color: #25D366;
    color: white;
    font-weight: bold;
    font-size: 1rem;
    border-radius: 8px;
    transition: all 0.3s ease;
  }

  .btn-wa:hover {
    background-color: #1ebe5d;
  }

  .paket-link {
  color: #000000; /* warna hitam */
  font-weight: 600;
  text-decoration: none;
}

.paket-link:hover {
  text-decoration: underline;
}

</style>

<section class="py-5 bg-light">
  <div class="container">
    <div class="row">

      {{-- KIRI --}}
      <div class="col-lg-7">

        <img src="{{ asset('img/' . $paketUmrahs->gambar_paket) }}" class="img-fluid rounded shadow mb-4" alt="{{ $paketUmrahs->nama_paket }}">

        <div class="custom-card mb-4">
          <div class="section-title">Informasi Paket</div>
          <div class="row">
            @php
              $infos = [
                ['icon' => 'fa-money-bill-wave', 'label' => 'Harga', 'value' => 'Rp ' . number_format($paketUmrahs->harga, 0, ',', '.')],
                ['icon' => 'fa-clock', 'label' => 'Durasi', 'value' => $paketUmrahs->jumlah_hari . ' Hari'],
                ['icon' => 'fa-hotel', 'label' => 'Hotel Makkah', 'value' => $paketUmrahs->hotel_makkah],
                ['icon' => 'fa-hotel', 'label' => 'Hotel Madinah', 'value' => $paketUmrahs->hotel_madinah],
              ];
            @endphp
            @foreach ($infos as $info)
            <div class="col-md-6">
              <div class="info-item">
                <div class="icon-circle2">
                  <i class="fa {{ $info['icon'] }}"></i>
                </div>
                <div>
                  <div class="text-muted">{{ $info['label'] }}</div>
                  <div class="text-dark">{{ $info['value'] }}</div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>

        <div class="custom-card mb-4">
          <div class="section-title">Fasilitas</div>
          <p>{!! nl2br(e($paketUmrahs->fasilitas)) !!}</p>
        </div>

        <div class="custom-card mb-5">
          <div class="section-title">Deskripsi</div>
          <p>{!! nl2br(e($paketUmrahs->deskripsi)) !!}</p>
        </div>

      </div>

      {{-- KANAN --}}
      <div class="col-lg-5">

        <div class="custom-card mb-4">
          <div class="section-title">📅 Jadwal Keberangkatan</div>
          @if ($jadwals->count())
            <ul class="list-group list-group-flush">
              @foreach ($jadwals as $jadwal)
                <li class="list-group-item d-flex justify-content-between align-items-start flex-column">
                  <div class="w-100 d-flex justify-content-between align-items-center">
                    <div>
                      <strong>{{ \Carbon\Carbon::parse($jadwal->tanggal_berangkat)->translatedFormat('d F Y') }}</strong><br>
                      <small>Kuota: {{ $jadwal->kuota }}</small>
                    </div>
                    <a href="{{ route('pengguna.formjamaah', ['jadwal_id' => $jadwal->id, 'paket_id' => $paketUmrahs->id]) }}"
                       class="btn btn-sm btn-outline-success btn-reservasi">Reservasi</a>
                  </div>
                </li>
              @endforeach
            </ul>
          @else
            <div class="alert alert-info">Belum ada jadwal tersedia.</div>
          @endif
        </div>

        <div class="custom-card mb-4 text-center">
          <a href="https://wa.me/6282286003630" target="_blank"
            class="btn btn-wa d-flex align-items-center justify-content-center gap-2 py-2 px-4">
            <i class='bx bxl-whatsapp'></i> Tanya Admin
          </a>
        </div>

        <div class="custom-card">
          <div class="section-title">✨ Paket Umrah Lainnya</div>
          @foreach ($otherPaketUmrahs as $other)
            <div class="other-paket-item">
              <img src="{{ asset('img/' . $other->gambar_paket) }}" alt="{{ $other->nama_paket }}">
              <div>
                <a href="{{ route('pengguna.detail_paket', $other->id) }}" class="paket-link">{{ $other->nama_paket }}</a>
                <div class="text-muted small">Rp {{ number_format($other->harga, 0, ',', '.') }}</div>
              </div>
            </div>
          @endforeach
        </div>

      </div>
    </div>
  </div>
</section>

@endsection
