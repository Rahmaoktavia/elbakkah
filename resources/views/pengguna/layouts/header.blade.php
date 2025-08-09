<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	<div class="container-fluid d-flex justify-content-between align-items-center px-4">

		<!-- Logo dan Nama Brand di kiri -->
		<div class="d-flex align-items-center">
			<img src="{{ asset('img/icons/brands/elbakkah.png') }}" alt="Logo El Bakkah" style="height: 60px; width: auto;">
			<a class="navbar-brand mb-0 ms-3">El Bakkah Travel</a>
		</div>

		<!-- Toggle button for mobile -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
			aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="oi oi-menu"></span> Menu
		</button>

		<!-- Menu kanan -->
		<div class="collapse navbar-collapse ms-auto justify-content-end" id="ftco-nav">
			<ul class="navbar-nav">
				<li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
					<a href="/" class="nav-link">Home</a>
				</li>
				<li class="nav-item {{ Request::is('paket-umrah*') ? 'active' : '' }}">
					<a href="/paket-umrah" class="nav-link">Paket Umrah</a>
				</li>
				<li class="nav-item {{ Request::is('galeri*') ? 'active' : '' }}">
					<a href="/galeri" class="nav-link">Galeri</a>
				</li>
				<li class="nav-item {{ Request::is('artikel*') ? 'active' : '' }}">
					<a href="/artikel" class="nav-link">Artikel</a>
				</li>
				<li class="nav-item {{ Request::is('tentangkami*') ? 'active' : '' }}">
					<a href="/tentangkami" class="nav-link">Tentang Kami</a>
				</li>
				<li class="nav-item {{ Request::is('contact-us*') ? 'active' : '' }}">
					<a href="{{ route('contact_us.contactUs') }}" class="nav-link">Contact Us</a>
				</li>

				@guest
					<li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
						<a href="{{ route('login') }}" class="nav-link">Login</a>
					</li>
					@else
					@php
						$user = Auth::user();
						$hasJamaah = $user->jamaah()->exists();
					@endphp
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-user-circle" style="font-size: 20px; margin-right: 6px;"></i>
							<span style="text-transform: capitalize;">{{ $user->name }}</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
							@if($hasJamaah)
								<a href="{{ route('jamaah.dokumenSaya') }}" class="dropdown-item">Dokumen Saya</a>
								<a href="{{ route('riwayat.reservasi') }}" class="dropdown-item">Riwayat Reservasi</a>
								<a href="{{ route('riwayat.perlengkapan') }}" class="dropdown-item">Riwayat Perlengkapan</a>
							@endif
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="dropdown-item p-0 m-0">
								@csrf
								<button type="button" class="btn btn-link dropdown-item" onclick="swalLogout()">Logout</button>
							</form>
						</div>
					</li>
				@endguest				
			</ul>
		</div>
	</div>
</nav>

<!-- SweetAlert2 Confirmation Script -->
<script>
	function swalLogout() {
		Swal.fire({
			title: 'Yakin ingin logout?',
			text: "Kamu akan keluar dari akun El Bakkah Travel.",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Logout',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.isConfirmed) {
				document.getElementById('logout-form').submit();
			}
		});
	}
</script>
