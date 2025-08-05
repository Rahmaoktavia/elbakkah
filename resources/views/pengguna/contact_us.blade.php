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
          <span>Contact Us</span>
        </p>
        <h1 class="mb-0 bread">Hubungi Kami</h1>
      </div>
    </div>
  </div>
</section>

{{-- Contact Info + Maps --}}
<section class="py-5" style="background-color: #ffffff;">
  <div class="container">
    <div class="row gy-4 align-items-start">
      {{-- Informasi Kontak --}}
      <div class="col-lg-6">
        <div class="bg-white p-4 rounded-4 shadow-sm">
          <h4 class="fw-bold text-dark mb-4 border-bottom pb-2">Kantor Pusat</h4>
          <p class="mb-2"><strong class="text-dark">El-Bakkah Travel Umrah</strong></p>
          <ul class="list-unstyled">
            <li class="mb-3 d-flex align-items-start">
              <i class="fa fa-map-marker text-primary me-2 mt-1"></i>
              <span class="text-dark">Jl. Lolong Karan No. 14 C, Sungai Sapih, Kec. Kuranji, Sumatera Barat 25173</span>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <i class="fa fa-phone text-primary me-2 mt-1"></i>
              <a href="https://wa.me/6282286003630" target="_blank" class="text-dark text-decoration-none">+62 822-8600-3630</a>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <i class="fa fa-envelope text-primary me-2 mt-1"></i>
              <a href="mailto:elbakkah4@gmail.com" class="text-dark text-decoration-none">elbakkah4@gmail.com</a>
            </li>
          </ul>
        </div>
      </div>

      {{-- Maps --}}
      <div class="col-lg-6">
        <div class="bg-white p-0 rounded-4 shadow-sm overflow-hidden">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1276.371112211408!2d100.36747243205393!3d-0.9175816484085082!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b9753ef70a11%3A0x8325d3f23920be03!2sEl-Bakkah%20Travel%20Umrah!5e0!3m2!1sid!2sid!4v1690000000000"
            width="100%"
            height="320"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Form Pertanyaan --}}
<section class="py-5" style="background-color: #f7f9fb;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="bg-white p-4 rounded-4 shadow-sm">
          <h4 class="fw-bold text-dark mb-4 border-bottom pb-2">Kirim Pertanyaan</h4>

          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <form action="{{ route('contact_us.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label fw-semibold">Nama</label>
              <input type="text" name="nama" class="form-control rounded-3" placeholder="Masukkan nama Anda" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Email</label>
              <input type="email" name="email" class="form-control rounded-3" placeholder="Contoh: email@example.com" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Pertanyaan</label>
              <textarea name="pertanyaan" rows="4" class="form-control rounded-3" placeholder="Tuliskan pertanyaan Anda..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary px-4 rounded-pill">Kirim Pertanyaan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- FAQ --}}
<section class="py-5" style="background-color: #ffffff;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="bg-white p-4 rounded-4 shadow-sm">
          <h4 class="fw-bold text-dark mb-4 border-bottom pb-2">Pertanyaan Umum (FAQ)</h4>

          @if($faqs->count())
            <div class="accordion" id="faqAccordion">
              @foreach ($faqs as $index => $faq)
                <div class="accordion-item mb-2 border rounded">
                  <h2 class="accordion-header" id="heading{{ $index }}">
                    <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                      {{ $faq->pertanyaan }}
                    </button>
                  </h2>
                  <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                      {{ $faq->jawaban ?? '-' }}
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <p class="text-muted">Belum ada FAQ yang tersedia.</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Optional Styling --}}
<style>
  .form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
    border-color: #86b7fe;
  }

  .btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
    transition: all 0.3s ease;
  }

  .btn-primary:hover {
    background-color: #0b5ed7;
    border-color: #0a58ca;
  }
</style>

@endsection
