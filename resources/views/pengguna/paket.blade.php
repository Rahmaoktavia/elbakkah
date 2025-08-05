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
<section class="ftco-section py-5 bg-white">
  <div class="container">
    <form action="{{ route('pengguna.paket') }}" method="GET"
      class="bg-white p-4 rounded border"
      style="box-shadow: 0 15px 45px rgba(0, 0, 0, 0.2); transition: all 0.3s ease;">
      
      <div class="d-flex flex-nowrap overflow-x-auto gap-3">

        {{-- Nama Paket --}}
        <div class="d-flex align-items-center px-3 py-2 bg-light rounded border shadow-sm" style="min-width: 220px;">
          <i class="fas fa-kaaba me-2"
            style="font-size: 18px; background: linear-gradient(45deg, #3498db, #6dd5fa); 
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
          <input type="text" name="search" class="form-control border-0 bg-light"
            placeholder="Cari Nama Paket..." value="{{ request('search') }}">
        </div>

        {{-- Durasi --}}
        <div class="d-flex align-items-center px-3 py-2 bg-light rounded border shadow-sm" style="min-width: 160px;">
          <i class="fas fa-clock me-2"
            style="font-size: 18px; background: linear-gradient(45deg, #3498db, #6dd5fa);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
          <select name="hari" class="form-select border-0 bg-light">
            <option value="">Durasi</option>
            @foreach(range(7, 35) as $hari)
              <option value="{{ $hari }}" {{ request('hari') == $hari ? 'selected' : '' }}>{{ $hari }} H</option>
            @endforeach
          </select>
        </div>

        {{-- Harga --}}
        <div class="d-flex align-items-center px-3 py-2 bg-light rounded border shadow-sm" style="min-width: 220px;">
          <i class="fas fa-money-bill-wave me-2"
            style="font-size: 18px; background: linear-gradient(45deg, #3498db, #6dd5fa);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
          <select name="harga" class="form-select border-0 bg-light">
            <option value="">Harga Maks</option>
            @foreach(range(5000000, 50000000, 5000000) as $harga)
              <option value="{{ $harga }}" {{ request('harga') == $harga ? 'selected' : '' }}>
                ≤ Rp {{ number_format($harga, 0, ',', '.') }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Tipe Paket --}}
        <div class="d-flex align-items-center px-3 py-2 bg-light rounded border shadow-sm" style="min-width: 200px;">
          <i class="fas fa-tag me-2"
            style="font-size: 18px; background: linear-gradient(45deg, #3498db, #6dd5fa);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
          <select name="tipe" class="form-select border-0 bg-light">
            <option value="">Tipe Paket</option>
            @foreach($tipePaketList as $tipe)
              <option value="{{ $tipe->id }}" {{ request('tipe') == $tipe->id ? 'selected' : '' }}>
                {{ $tipe->nama_tipe }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Tombol Cari --}}
        <div class="d-flex align-items-center px-3 py-2">
          <button type="submit" class="btn btn-primary fw-bold shadow-sm px-4 py-2">
            <i class="fas fa-search me-1"></i> 
          </button>
        </div>

      </div>
    </form>
  </div>
</section>

{{-- PAKET --}}
<section class="py-5 bg-light" id="paket">
  <div class="container">

    <div class="row g-4">
      @forelse($paketUmrahs as $paket)
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 paket-card shadow-lg">
        {{-- Gambar + Label --}}
        <div class="position-relative">
          {{-- Gambar --}}
          <img src="{{ asset('img/'.$paket->gambar_paket) }}" class="card-img-top card-img-custom" alt="Gambar Paket" style="height: 270px; object-fit: cover;">

          {{-- Label Tipe Paket --}}
          @if ($paket->tipePaket)
            <div class="label-tipe-paket {{ strtolower($paket->tipePaket->nama_tipe) }}">
              {{ strtoupper($paket->tipePaket->nama_tipe) }}
            </div>
          @endif
        </div>

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
