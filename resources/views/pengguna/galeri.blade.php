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

{{-- Galeri Section --}}
<section class="gallery-container py-5" style="background-color: #f7f9fb;">
  <div class="container">
    <div class="row g-4">
      @forelse ($galeris as $galeri)
        <div class="col-md-4 col-sm-6 mb-4">
          <div class="galeri-item" style="background-image: url('{{ asset('img/' . $galeri->file_foto) }}');" onclick="openLightbox('{{ asset('img/' . $galeri->file_foto) }}')">
            <div class="overlay-info">
              <h5 class="judul">{{ $galeri->judul_foto }}</h5>
              <p class="deskripsi">{{ $galeri->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
              <div class="tanggal">
                <i class="fa fa-calendar mr-1"></i>
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

{{-- Lightbox Modal --}}
<div id="lightbox" onclick="closeLightbox()">
  <span class="close">&times;</span>
  <img class="lightbox-content" id="lightbox-img">
</div>

{{-- CSS --}}
<style>
  .galeri-item {
    position: relative;
    background-size: cover;
    background-position: center;
    height: 300px;
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease;
    cursor: zoom-in;
  }

  .galeri-item:hover {
    transform: scale(1.02);
  }

  .overlay-info {
    position: absolute;
    bottom: 0;
    background: linear-gradient(to top, rgba(0, 0, 50, 0.85), rgba(0, 0, 50, 0.1));
    color: #fff;
    padding: 20px;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
  }

  .galeri-item:hover .overlay-info {
    opacity: 1;
  }

  .judul {
    font-size: 22px;
    font-weight: 800;
    margin-bottom: 10px;
    letter-spacing: 0.5px;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
    color: #ffe;
  }

  .deskripsi {
    font-size: 14px;
    line-height: 1.5;
    margin-bottom: 12px;
    color: #ddd;
  }

  .tanggal {
    font-size: 13px;
    color: #ccc;
  }

  @media (max-width: 768px) {
    .galeri-item {
      height: 220px;
    }

    .judul {
      font-size: 18px;
    }
  }

  /* Lightbox CSS */
  #lightbox {
    display: none;
    position: fixed;
    z-index: 9999;
    padding-top: 80px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.9);
    text-align: center;
  }

  .lightbox-content {
    margin: auto;
    display: block;
    max-width: 80%;
    max-height: 80%;
    border-radius: 8px;
  }

  .close {
    position: absolute;
    top: 30px;
    right: 50px;
    color: white;
    font-size: 35px;
    font-weight: bold;
    cursor: pointer;
  }

  .close:hover {
    color: #ccc;
  }
</style>

{{-- JavaScript --}}
<script>
  function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox').style.display = 'block';
  }

  function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
  }
</script>

@endsection
