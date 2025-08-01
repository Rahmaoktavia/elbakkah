@extends('pengguna.layouts.main')
@section('content')

{{-- HERO --}}
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('images/image_home.png') }}'); height: 923px;">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center" style="height: 923px;">
      <div class="col-md-9 ftco-animate pb-5 text-center fadeInUp ftco-animated">
        <p class="breadcrumbs">
          <span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> 
          <span>Tentang Kami <i class="fa fa-chevron-right"></i></span>
        </p>
        <h1 class="mb-0 bread">Tentang Kami</h1>
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">

    {{-- Profil Singkat --}}
    <div class="text-center mb-5">
      <h2 class="section-title mb-3 fw-bold text-dark">Profil Singkat</h2>
      <p class="lead mx-auto text-dark" style="max-width: 800px;">
        El Bakkah Travel adalah perusahaan profesional di bidang perjalanan ibadah umrah. Sejak berdiri pada Mei 2019, kami hadir sebagai mitra perjalanan yang amanah, terpercaya, dan berkomitmen menghadirkan pengalaman spiritual terbaik bagi setiap jamaah.
      </p>
    </div>

    {{-- Latar Belakang --}}
    <div class="row align-items-center mb-5">
      <div class="col-md-6">
        <h4 class="fw-bold text-dark">Latar Belakang</h4>
        <p class="lead mx-auto text-dark">El Bakkah berdiri pada bulan Mei tahun 2019 dengan enam anggota. Namun, dua orang di antaranya kemudian mendirikan PT sendiri. Awalnya, kantor kami berada di Jl. Dr. Moh Hatta Anduring, di depan Masjid Kebenaran.</p>
        <p class="lead mx-auto text-dark">Pada Februari 2020, kantor berpindah ke By Pass (samping Pegadaian), namun hanya sebulan karena pandemi. Kini, El Bakkah beralamat di Jl. Lolong Karan No. 14 C, Sungai Sapih, Kuranji, Padang.</p>
      </div>
      <div class="col-md-6 text-center">
        <img src="{{ asset('img/icons/brands/el-bakkah.png') }}" alt="Kantor El Bakkah" class="img-fluid rounded shadow" style="max-width: 80%;">
      </div>
    </div>

    {{-- Visi dan Misi --}}
    <div class="row mb-5">
      <div class="col-md-6">
        <h4 class="fw-bold text-dark">Visi</h4>
        <p class="lead mx-auto text-dark">Menjadi perusahaan penyelenggara perjalanan ibadah umrah yang amanah dan menginspirasi jamaah dalam ibadah suci mereka.</p>
      </div>
      <div class="col-md-6">
        <h4 class="fw-bold text-dark">Misi</h4>
        <ul>
          <li class="lead mx-auto text-dark">Memberikan pelayanan terbaik dan profesional</li>
          <li class="lead mx-auto text-dark">Menjaga kepercayaan dan kepuasan jamaah</li>
          <li class="lead mx-auto text-dark">Menjalin hubungan silaturahmi berkelanjutan</li>
        </ul>
      </div>
    </div>

    {{-- Sertifikasi Legalitas --}}
    <div class="mb-5">
      <h4 class="fw-bold text-center mb-4 text-dark">Sertifikasi Legalitas</h4>
      <div class="row justify-content-center">
        <div class="col-md-5 mb-3 text-center">
          <img src="{{ asset('img/sertifikat-elbakkah1.jpg') }}" alt="Sertifikat 1" class="img-fluid rounded shadow" style="max-height: 320px;">
        </div>
        <div class="col-md-5 mb-3 text-center">
          <img src="{{ asset('img/sertifikat-elbakkah2.jpg') }}" alt="Sertifikat 2" class="img-fluid rounded shadow" style="max-height: 320px;">
        </div>
      </div>
    </div>

    {{-- Legalitas Perusahaan --}}
    <div class="mb-5">
      <h4 class="fw-bold text-dark">Legalitas Perusahaan</h4>
      <ul>
        <li class="lead mx-auto text-dark"><strong>Akta Pendirian:</strong> 13 Mei 2019 No.01 – SK Kemenkumham AHU-0025590.AH.01.01 Tahun 2019</li>
        <li class="lead mx-auto text-dark"><strong>Akta Perubahan 1:</strong> 16 Maret 2020 No.12 – SK Kemenkumham AHU-AH.01.03-0145753</li>
        <li class="lead mx-auto text-dark"><strong>Akta Perubahan 2:</strong> 22 Juni 2023 No.14 – SK Kemenkumham AHU-AH.01.03-0082055</li>
        <li class="lead mx-auto text-dark"><strong>NIB:</strong> 1406220023715</li>
        <li class="lead mx-auto text-dark"><strong>SK Kementerian Agama RI:</strong> 14062200237150002 – SK 19 April 2024</li>
      </ul>
    </div>

    {{-- Struktur Organisasi --}}
    <div class="mb-5 text-center">
      <h4 class="fw-bold text-dark mb-4">Struktur Organisasi</h4>
      <img src="{{ asset('img/struktur-organisasi.png') }}" alt="Struktur Organisasi El Bakkah" class="img-fluid rounded shadow" style="max-width: 100%; max-height: 500px;">
    </div>

    {{-- Layanan Kami --}}
    <section class="ftco-section bg-light py-5">
        <div class="container">
          <div class="text-center mb-5">
            <h4 class="fw-bold mb-4 text-dark">Layanan Kami</h4>
          </div>
          <div class="row text-center">
            <div class="col-md-4 mb-4">
              <div class="card-gradient text-center p-4 h-100">
                <div class="icon-circle mb-3 text-primary">
                  <i class="fas fa-hands-helping fa-2x"></i>
                </div>
                <h5 class="fw-bold text-dark">Pelayanan Terbaik</h5>
                <p class="text-muted">Memiliki pengalaman dan keahlian dalam mengorganisir perjalanan umrah dapat memberikan pelayanan yang lebih baik kepada jamaah</p>
              </div>
            </div>
      
            <div class="col-md-4 mb-4">
              <div class="card-gradient text-center p-4 h-100">
                <div class="icon-circle mb-3 text-success">
                  <i class="fas fa-hotel fa-2x"></i>
                </div>
                <h5 class="fw-bold text-dark">Akomodasi Nyaman</h5>
                <p class="text-muted">Penyedia umrah yang berkualitas akan menyediakan akomodasi yang nyaman dan sesuai dengan kebutuhan jamaah selama mereka berada di Tanah Suci</p>
              </div>
            </div>
      
            <div class="col-md-4 mb-4">
              <div class="card-gradient text-center p-4 h-100">
                <div class="icon-circle mb-3 text-warning">
                  <i class="fas fa-calendar-alt fa-2x"></i>
                </div>
                <h5 class="fw-bold text-dark">Program Fleksibel</h5>
                <p class="text-muted">Menawarkan berbagai pilihan program umrah, termasuk program reguler, special promo, dan paket full ramadhan, sehingga jamaah dapat memilih sesuai dengan anggaran dan preferensi mereka</p>
              </div>
            </div>
          </div>
        </div>
      </section>      

  </div>
</section>

@endsection
