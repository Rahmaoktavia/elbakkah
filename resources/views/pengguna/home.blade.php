@extends('pengguna.layouts.main')
@section('content')

		<div class="hero-wrap js-fullheight" style="background-image: url('{{ asset('images/image_home.png') }}');">
			<div class="overlay"></div>
			<div class="container">
				<div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
					<div class="col-md-7 ftco-animate">
						<span class="subheading">Selamat Datang di El-Bakkah Travel</span>
						<h1 class="mb-4">Temani Langkah Suci Anda Menuju Tanah Haram</h1>
						<p class="caps">Perjalanan spiritual yang nyaman, aman, dan penuh keberkahan</p>
					</div>
				</div>
			</div>
		</div>

		{{-- PAKET UMRAH DI HOMEPAGE --}}
		<section class="py-5 bg-light" id="paket-umrah-home">
			<div class="container">
				<h2 class="text-center mb-2 fw-bold text-dark">
					Paket Umrah yang Tersedia
				</h2>				
				  <p class="text-center text-muted mb-4" style="max-width: 600px; margin: 0 auto;">
					Pilih paket umrah terbaik sesuai kebutuhan Anda. Dengan bimbingan profesional dan pelayanan terbaik, kami siap menemani langkah ibadah Anda menuju Tanah Suci dengan aman, nyaman, dan penuh keberkahan.
				  </p>				  
		
			<div class="row g-4">
				@foreach($paketUmrahs->take(3) as $paket)
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
						<div class="d-flex justify-content-between align-items-center mb-3">
						<div class="icon-pill bg-soft-warning text-warning">
							<i class='bx bx-time-five'></i>
							<span class="icon-text">Durasi</span>
						</div>
						<span class="info-text text-end">{{ $paket->jumlah_hari }} Hari</span>
						</div>
		
						<div class="d-flex justify-content-between align-items-center mb-3">
						<div class="icon-pill bg-soft-primary text-primary">
							<i class="fas fa-kaaba"></i>
							<span class="icon-text">Makkah</span>
						</div>
						<span class="info-text text-end">{{ $paket->hotel_makkah }}</span>
						</div>
		
						<div class="d-flex justify-content-between align-items-center mb-3">
						<div class="icon-pill bg-soft-danger text-danger">
							<i class="fas fa-mosque"></i>
							<span class="icon-text">Madinah</span>
						</div>
						<span class="info-text text-end">{{ $paket->hotel_madinah }}</span>
						</div>
					</div>
		
					<hr class="my-3 garis-halus">
		
					<div class="mt-auto text-center">
						<div class="harga-text mb-3">
						Rp {{ number_format($paket->harga, 0, ',', '.') }}
						</div>
						<a href="{{ route('pengguna.detail_paket', $paket->id) }}" class="btn btn-detail-paket w-100">Detail Paket</a>
					</div>
					</div>
				</div>
				</div>
				@endforeach
			</div>
		
			<div class="text-center mt-5">
				<a href="{{ route('pengguna.paket') }}" class="btn btn-primary shadow-sm px-4 py-2">Lihat Semua Paket</a>
			</div>
			</div>
		</section>
  
		<section class="ftco-section bg-light py-5">
			<div class="container">
			  <div class="text-center mb-5">
				<h2 class="font-weight-bold text-dark">Alasan Kenapa Harus Memilih El-Bakkah Travel</h2>
				<p class="text-muted" style="max-width: 700px; margin: 0 auto;">
				  El-Bakkah Travel berkomitmen menjadi mitra perjalanan spiritual Anda dengan pelayanan terbaik, amanah, dan penuh keberkahan.
				</p>
			  </div>
		  
			  <div class="row">
				<!-- Card -->
				<div class="col-md-4 mb-4">
				  <div class="card-gradient text-center p-4 h-100">
					<div class="icon-circle mb-3">
					  <i class="fas fa-check-circle fa-2x"></i>
					</div>
					<h5 class="fw-bold text-dark">Resmi & Terpercaya</h5>
					<p class="text-muted">Terdaftar resmi di Kemenag RI, menjamin perjalanan yang aman dan sesuai regulasi.</p>
				  </div>
				</div>
		  
				<div class="col-md-4 mb-4">
				  <div class="card-gradient text-center p-4 h-100">
					<div class="icon-circle mb-3">
					  <i class="fas fa-plane-departure fa-2x"></i>
					</div>
					<h5 class="fw-bold text-dark">Jaminan Pasti Berangkat</h5>
					<p class="text-muted">Keberangkatan sesuai jadwal, tanpa penundaan. Kepastian untuk ibadah yang tenang.</p>
				  </div>
				</div>
		  
				<div class="col-md-4 mb-4">
				  <div class="card-gradient text-center p-4 h-100">
					<div class="icon-circle mb-3">
					  <i class="fas fa-user-graduate fa-2x"></i>
					</div>
					<h5 class="fw-bold text-dark">Pembimbing Bersertifikat</h5>
					<p class="text-muted">Dampingi oleh pembimbing umrah bersertifikat dan sesuai sunnah untuk ibadah yang berkualitas.</p>
				  </div>
				</div>
		  
				<div class="col-md-4 mb-4">
				  <div class="card-gradient text-center p-4 h-100">
					<div class="icon-circle mb-3">
					  <i class="fas fa-hotel fa-2x"></i>
					</div>
					<h5 class="fw-bold text-dark">Fasilitas Nyaman & Lengkap</h5>
					<p class="text-muted">Hotel dekat Masjidil Haram/Nabawi, transportasi AC, dan makanan sesuai cita rasa Indonesia.</p>
				  </div>
				</div>
		  
				<div class="col-md-4 mb-4">
				  <div class="card-gradient text-center p-4 h-100">
					<div class="icon-circle mb-3">
					  <i class="fas fa-calendar-check fa-2x"></i>
					</div>
					<h5 class="fw-bold text-dark">Pengalaman Bertahun-tahun</h5>
					<p class="text-muted">Ribuan jamaah telah diberangkatkan sejak awal berdiri, dengan kepuasan yang tinggi.</p>
				  </div>
				</div>
		  
				<div class="col-md-4 mb-4">
				  <div class="card-gradient text-center p-4 h-100">
					<div class="icon-circle mb-3">
					  <i class="fas fa-hands-helping fa-2x"></i>
					</div>
					<h5 class="fw-bold text-dark">Pendampingan Sepanjang Perjalanan</h5>
					<p class="text-muted">Mulai dari manasik hingga pulang ke tanah air, kami selalu ada untuk Anda.</p>
				  </div>
				</div>
			  </div>
			</div>
		  </section>
		  
		  <section class="ftco-section bg-light py-5">
			<div class="container">
			  <div class="row justify-content-center mb-4">
				<div class="col-md-10 text-center">
				  <h2 class="font-weight-bold text-dark">Galeri Kegiatan Jamaah Umrah</h2>
				  <p class="text-muted">Potret momen kebersamaan, ibadah penuh makna, dan perjalanan spiritual para jamaah El-Bakkah Travel.</p>
				</div>
			  </div>
		  
			  <div class="row g-4">
				@forelse ($galeris as $galeri)
				  <div class="col-md-4 col-sm-6">
					<div class="galeri-item" style="background-image: url('{{ asset('img/' . $galeri->file_foto) }}');" onclick="openLightbox('{{ asset('img/' . $galeri->file_foto) }}')">
					  <div class="overlay-info">
						<h5 class="judul">{{ $galeri->judul_foto }}</h5>
						<p class="deskripsi">{{ $galeri->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
						<div class="tanggal">
						  <i class="fa fa-calendar mr-1"></i>
						  {{ \Carbon\Carbon::parse($galeri->tanggal_upload)->translatedFormat('d F Y') }}
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

		  <section class="ftco-section">
			<div class="container">
			  <div class="row justify-content-center pb-4">
				<div class="col-md-12 heading-section text-center ftco-animate">
				  <span class="subheading">Artikel</span>
				  <h2 class="mb-4">Artikel Terbaru Kami</h2>
				  <p class="text-muted">Dapatkan wawasan dan inspirasi terbaru seputar perjalanan ibadah dan pengalaman jamaah.</p>
				</div>
			  </div>
			  <div class="row d-flex">
				@foreach ($artikels->take(3) as $artikel)
				  <div class="col-md-4 d-flex ftco-animate">
					<div class="blog-entry justify-content-end">
					  <a href="{{ route('pengguna.detail_artikel', $artikel->id) }}" class="block-20" style="background-image: url('{{ asset('img/' . $artikel->gambar_sampul) }}');"></a>
					  <div class="text">
						<div class="d-flex align-items-center mb-4 topp">
						  <div class="one">
							<span class="day">{{ \Carbon\Carbon::parse($artikel->tanggal_terbit)->format('d') }}</span>
						  </div>
						  <div class="two">
							<span class="yr">{{ \Carbon\Carbon::parse($artikel->tanggal_terbit)->format('Y') }}</span>
							<span class="mos">{{ \Carbon\Carbon::parse($artikel->tanggal_terbit)->translatedFormat('F') }}</span>
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
			  <!-- Tombol "Lihat Semua Artikel" -->
			<div class="row justify-content-center mt-3">
				<div class="col-auto">
				<a href="{{ route('pengguna.artikel') }}" class="btn btn-primary shadow-sm px-4 py-2">
					Lihat Semua Artikel
				</a>
				</div>
			</div>
		  </section>		  
		<!-- Lightbox Modal -->
		<div id="lightbox" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.8); z-index:9999; justify-content:center; align-items:center;">
		
			<!-- Tombol Close -->
			<span onclick="closeLightbox()" style="position:absolute; top:20px; right:30px; font-size:40px; color:white; cursor:pointer;">&times;</span>
		
			<!-- Gambar -->
			<img id="lightbox-img" src="" alt="Preview Gambar" style="max-width:90%; max-height:90%; border:5px solid white; border-radius:10px;">
		</div>
		<script>
			function openLightbox(src) {
			  document.getElementById('lightbox-img').src = src;
			  document.getElementById('lightbox').style.display = 'block';
			}
		  
			function closeLightbox() {
			  document.getElementById('lightbox').style.display = 'none';
			}
		  </script>
		  

			<!-- loader -->
			<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
@endsection

