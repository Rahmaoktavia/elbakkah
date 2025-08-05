@extends('pengguna.layouts.main')
@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url(&quot;images/image_home.png&quot;); height: 923px;">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center" style="height: 923px;">
      <div class="col-md-9 ftco-animate pb-5 text-center fadeInUp ftco-animated">
       <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> <span>Artikel <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">Artikel</h1>
     </div>
   </div>
 </div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="row d-flex">
      @foreach ($artikels as $artikel)
        <div class="col-md-4 d-flex ftco-animate">
          <div class="blog-entry justify-content-end">
            <a href="#" class="block-20" style="background-image: url('{{ asset('img/' . $artikel->gambar_sampul) }}');">
            </a>
            <div class="text">
              <div class="d-flex align-items-center mb-4 topp">
                <div class="one">
                  <span class="day">{{ \Carbon\Carbon::parse($artikel->created_at)->format('d') }}</span>
                </div>
                <div class="two">
                  <span class="yr">{{ \Carbon\Carbon::parse($artikel->created_at)->format('Y') }}</span>
                  <span class="mos">{{ \Carbon\Carbon::parse($artikel->created_at)->translatedFormat('F') }}</span>
                </div>
              </div>
              <h3 class="heading">
            <a href="{{ route('pengguna.detail_artikel', $artikel->id) }}">{{ $artikel->judul_artikel }}</a>
            </h3>
            <p>{{ Str::limit(strip_tags($artikel->isi_artikel), 100, '...') }}</p>
            <p><a href="{{ route('pengguna.detail_artikel', $artikel->id) }}" class="btn btn-primary">Baca selengkapnya</a></p>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    {{-- Pagination --}}
    <div class="row mt-5">
    <div class="col d-flex justify-content-center">
        <div class="block-27">
        {{ $artikels->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
    </div>

</section>

@endsection
