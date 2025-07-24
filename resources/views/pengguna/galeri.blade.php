@extends('pengguna.layouts.main')

@section('content')

{{-- Hero Section --}}
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('images/image_home.png') }}'); height: 500px;">
  <div class="overlay" style="background-color: rgba(0, 0, 50, 0.5);"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center" style="height: 500px;">
      <div class="col-md-9 ftco-animate pb-5 text-center text-white">
        <p class="breadcrumbs">
          <span class="mr-2"><a href="/" class="text-white">Home <i class="fa fa-chevron-right"></i></a></span>
          <span>Galeri</span>
        </p>
        <h1 class="mb-0 bread">Galeri</h1>
      </div>
    </div>
  </div>
</section>


{{-- Custom Styling --}}
<style>
  .gallery-container {
    padding: 60px 0;
    background-color: #f7f9fb;
  }

  .card-gallery {
    border: none;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background: #fff;
    display: flex;
    flex-direction: column;
  }

  .card-gallery:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
  }

  .card-gallery img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-bottom: 2px solid #eaeaea;
  }

  .card-body-gallery {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
  }

  .judul-foto {
    font-weight: bold;
    font-size: 18px;
    color: #1b1b1b;
    margin-bottom: 20px;
    position: relative;
  }

  .judul-foto::after {
    content: "";
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 100%;
    height: 1px;
    background-color: #ddd;
  }

  .deskripsi-foto {
    font-size: 14px;
    color: #555;
    margin-top: 10px;
    line-height: 1.6;
    flex-grow: 1;
  }

  .tanggal-upload {
    font-size: 13px;
    color: #666;
    margin-top: 15px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .tanggal-upload i {
    color: #666;
    font-size: 14px;
  }

  @media (max-width: 768px) {
    .card-gallery img {
      height: 200px;
    }
  }
</style>

{{-- Galeri Section --}}
<section class="gallery-container">
  <div class="container">
    <div class="row">
      @forelse ($galeris as $galeri)
        <div class="col-md-4 mb-4 d-flex align-items-stretch">
          <div class="card-gallery w-100">
            <img src="{{ asset('img/' . $galeri->file_foto) }}" alt="{{ $galeri->judul_foto }}">
            <div class="card-body-gallery">
              <div class="judul-foto">{{ $galeri->judul_foto }}</div>
              <div class="deskripsi-foto">{{ $galeri->deskripsi ?? 'Tidak ada deskripsi.' }}</div>
              <div class="tanggal-upload">
                <i class="fa fa-calendar"></i>
                {{ \Carbon\Carbon::parse($galeri->tanggal_upload)->translatedFormat('d M Y') }}
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center">
          <p>Belum ada galeri yang tersedia.</p>
        </div>
      @endforelse
    </div>

    {{-- Pagination --}}
    <div class="row mt-5">
      <div class="col d-flex justify-content-center">
        <div class="block-27">
          {{ $galeris->links('vendor.pagination.bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
