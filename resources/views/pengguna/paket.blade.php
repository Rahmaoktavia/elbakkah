@extends('pengguna.layouts.main')
@section('content')

{{-- HERO --}}
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url(&quot;images/image_home.png&quot;); height: 923px;">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center" style="height: 923px;">
        <div class="col-md-9 ftco-animate pb-5 text-center fadeInUp ftco-animated">
         <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> <span>Paket Umrah <i class="fa fa-chevron-right"></i></span></p>
         <h1 class="mb-0 bread">Paket Umrah</h1>
       </div>
     </div>
   </div>
  </section>

{{-- FILTER PENCARIAN --}}
<section class="ftco-section bg-white py-5">
  <div class="container">
    <div class="p-4 rounded shadow-lg bg-light"> {{-- Shadow Card --}}
      <form action="{{ route('pengguna.paket') }}" method="GET" class="search-property-1">
        <div class="row g-3 justify-content-center">

          {{-- Search Nama Paket --}}
          <div class="col-md-4">
            <div class="form-group">
              <label class="fw-bold">Nama Paket</label>
              <div class="form-field">
                <input type="text" name="search" class="form-control" placeholder="Cari nama paket..." value="{{ request('search') }}">
              </div>
            </div>
          </div>

          {{-- Durasi (Jumlah Hari) --}}
          <div class="col-md-3">
            <div class="form-group">
              <label class="fw-bold">Durasi (Hari)</label>
              <select name="hari" class="form-control">
                <option value="">Semua Durasi</option>
                @foreach(range(7, 35) as $hari)
                  <option value="{{ $hari }}" {{ request('hari') == $hari ? 'selected' : '' }}>{{ $hari }} Hari</option>
                @endforeach
              </select>
            </div>
          </div>

          {{-- Harga Maksimum --}}
          <div class="col-md-3">
            <div class="form-group">
              <label class="fw-bold">Harga Maksimal</label>
              <select name="harga" class="form-control">
                <option value="">Semua Harga</option>
                @foreach(range(5000000, 50000000, 5000000) as $harga)
                  <option value="{{ $harga }}" {{ request('harga') == $harga ? 'selected' : '' }}>
                    Maks Rp {{ number_format($harga, 0, ',', '.') }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          {{-- Tombol Submit --}}
          <div class="col-md-2 d-flex align-items-end">
            <div class="form-group w-100">
              <button type="submit" class="btn btn-primary w-100 shadow-sm">
                <i class="fa fa-search me-2"></i>Cari
              </button>
            </div>
          </div>

        </div>
      </form>
    </div>
  </div>
</section>

{{-- PAKET --}}
<section class="py-5 bg-light" id="paket">
  <div class="container">

    <div class="row g-4">
      @forelse($paketUmrahs as $paket)
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 paket-card shadow-lg">
          {{-- Gambar --}}
          <img src="{{ asset('img/'.$paket->gambar_paket) }}" class="card-img-top card-img-custom" alt="Gambar Paket">

          {{-- Konten --}}
          <div class="card-body p-4 d-flex flex-column">
            {{-- Nama Paket --}}
            <h5 class="nama-paket text-uppercase text-center mb-4">{{ $paket->nama_paket }}</h5>

            {{-- Info Rows --}}
            <div class="d-flex flex-column">

            {{-- Durasi --}}
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="icon-pill bg-soft-warning text-warning">
                  <i class='bx bx-time-five'></i>
                  <span class="icon-text">Durasi</span>
                </div>
                <span class="info-text text-end">{{ $paket->jumlah_hari }} Hari</span>
              </div>
            </div>

              {{-- Hotel Makkah --}}
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="icon-pill bg-soft-primary text-primary">
                  {{-- <i class='bx bx-map'></i> --}}
                  <i class="fas fa-kaaba"></i>
                  <span class="icon-text">Makkah</span>
                </div>
                <span class="info-text text-end">{{ $paket->hotel_makkah }}</span>
              </div>

              {{-- Hotel Madinah --}}
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="icon-pill bg-soft-danger text-danger">
                  {{-- <i class='bx bx-map-pin'></i> --}}
                  <i class="fas fa-mosque"></i>
                  <span class="icon-text">Madinah</span>
                </div>
                <span class="info-text text-end">{{ $paket->hotel_madinah }}</span>
              </div>

            {{-- Garis Halus --}}
            <hr class="my-3 garis-halus">

            {{-- Harga + Tombol --}}
            <div class="mt-auto text-center">
              <div class="harga-text mb-3">
                Rp {{ number_format($paket->harga, 0, ',', '.') }}
              </div>
              <a href="{{ route('pengguna.detail_paket', $paket->id) }}" class="btn btn-detail-paket w-100">Detail Paket</a>
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12 text-center">
        <p class="text-muted">Belum ada paket tersedia saat ini.</p>
      </div>
      @endforelse
    </div>

    {{-- Pagination --}}
    <div class="row mt-5">
        <div class="col d-flex justify-content-center">
            <div class="block-27">
            {{ $paketUmrahs->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
  </div>
</section>

@endsection
