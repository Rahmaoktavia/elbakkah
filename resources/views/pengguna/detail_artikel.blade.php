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
          <span class="mr-2"><a href="/artikel">Artikel <i class="fa fa-chevron-right"></i></a></span>
          <span>{{ $artikel->judul_artikel }}</span>
        </p>
        <h1 class="mb-0 bread">{{ $artikel->judul_artikel }}</h1>
      </div>
    </div>
  </div>
</section>

{{-- Konten --}}
<section class="ftco-section">
  <div class="container">
    <div class="row">

      {{-- Konten Utama Artikel --}}
      <div class="col-md-8">
        <div class="blog-entry">
          <div class="block-20 mb-4" style="background-image: url('{{ asset('img/' . $artikel->gambar_sampul) }}'); height: 400px; background-size: cover; border-radius: 10px;"></div>
          <div class="text">
            <p class="text-muted">{{ \Carbon\Carbon::parse($artikel->tanggal_terbit)->translatedFormat('d F Y') }}</p>
            <h2 class="mb-4">{{ $artikel->judul_artikel }}</h2>
            <div>{!! $artikel->isi_artikel !!}</div>
          </div>
        </div>
      </div>

      {{-- Sidebar: Artikel Terbaru --}}
        <div class="col-md-4">
        <div class="sidebar">
            <h5 class="mb-4">Artikel Terbaru</h5>
            @foreach ($artikelTerbaru as $item)
            @php
                $isActive = $item->id == $artikel->id ? 'active-artikel' : '';
            @endphp
            <div class="d-flex mb-3 align-items-start {{ $isActive }}" style="gap: 10px;">
                <a href="{{ route('pengguna.detail_artikel', $item->id) }}" class="me-3" style="
                    width: 80px;
                    height: 60px;
                    background-image: url('{{ asset('img/' . $item->gambar_sampul) }}');
                    background-size: cover;
                    background-position: center;
                    border-radius: 5px;
                    display: block;
                "></a>
                <div class="text ms-2">
                <h6 class="mb-1" style="font-size: 14px;">
                    <a href="{{ route('pengguna.detail_artikel', $item->id) }}" style="color: #000; text-decoration: none;">
                    {{ Str::limit($item->judul_artikel, 50) }}
                    </a>
                </h6>
                <small class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal_terbit)->translatedFormat('d M Y') }}</small>
                </div>
            </div>
            @endforeach
        </div>
        </div>
    </div>
  </div>
</section>

@endsection
