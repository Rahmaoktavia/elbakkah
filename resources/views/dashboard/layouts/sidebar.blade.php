<aside id="layout-menu"
  class="layout-menu menu-vertical menu bg-white shadow-sm border-end"
  style="height: 100vh; border-radius: 0;">

    <!-- Logo El Bakkah + Nama -->
    <div class="app-brand d-flex align-items-center px-3 py-3">
        <img src="{{ asset('img/icons/brands/elbakkah.png') }}"
            alt="Logo El Bakkah"
            style="height: 48px; width: auto; object-fit: contain; margin-right: 12px;">

        <span class="fw-bold text-dark fs-5 text-wrap" style="line-height: 1.3;">
            El Bakkah Travel 
        </span>
    </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">

   <!-- Dashboard -->
<li class="menu-item {{ request()->is('dashboard') ? 'active-custom' : '' }}">
    <a href="{{ route('dashboard.index') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-home-smile"></i>
      <div class="text-truncate">Dashboard</div>
    </a>
  </li>
  
  <!-- Menu Khusus untuk ADMIN -->
  @if (Auth::user()->role === 'Admin')
      <!-- Paket Umrah -->
      <li class="menu-item {{ request()->is('admin/paket*') ? 'active-custom' : '' }}">
          <a href="{{ route('dashboard.paket.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-briefcase-alt"></i>
              <div class="text-truncate">Paket Umrah</div>
          </a>
      </li>

      <!-- Tipe Paket -->
    <li class="menu-item {{ request()->is('admin/tipe-paket*') ? 'active-custom' : '' }}">
        <a href="{{ route('dashboard.tipe-paket.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-category"></i>
            <div class="text-truncate">Tipe Paket</div>
        </a>
    </li>
  
      <!-- Jadwal Keberangkatan -->
      <li class="menu-item {{ request()->is('admin/jadwal*') ? 'active-custom' : '' }}">
          <a href="{{ route('dashboard.jadwal.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-calendar"></i>
              <div class="text-truncate">Jadwal Keberangkatan</div>
          </a>
      </li>
  
      <!-- Jamaah -->
      <li class="menu-item {{ request()->is('admin/jamaah*') ? 'active-custom' : '' }}">
          <a href="{{ route('dashboard.jamaah.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-user-detail"></i>
              <div class="text-truncate">Jamaah</div>
          </a>
      </li>
  @endif
  
  <!-- Menu untuk Admin & Direktur Keuangan -->
  @if (in_array(Auth::user()->role, ['Admin', 'Direktur Keuangan']))
      <!-- Pemesanan -->
      <li class="menu-item {{ request()->is('manajemen/pemesanan*') ? 'active-custom' : '' }}">
          <a href="{{ route('dashboard.pemesanan.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-book"></i>
              <div class="text-truncate">Pemesanan</div>
          </a>
      </li>
  
      <!-- Pembayaran -->
      <li class="menu-item {{ request()->is('manajemen/pembayaran*') ? 'active-custom' : '' }}">
          <a href="{{ route('dashboard.pembayaran.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-money"></i>
              <div class="text-truncate">Pembayaran</div>
          </a>
      </li>
  @endif
  
  <!-- Menu Tambahan untuk ADMIN -->
  @if (Auth::user()->role === 'Admin')
      <!-- Inventaris -->
      <li class="menu-item {{ request()->is('admin/inventaris*') ? 'active-custom' : '' }}">
          <a href="{{ route('dashboard.inventaris.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-package"></i>
              <div class="text-truncate">Inventaris</div>
          </a>
      </li>
  
      <!-- Distribusi Perlengkapan -->
      <li class="menu-item {{ request()->is('admin/distribusi*') ? 'active-custom' : '' }}">
          <a href="{{ route('dashboard.distribusi.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-transfer-alt"></i>
              <div class="text-truncate">Distribusi</div>
          </a>
      </li>
  
      <!-- Galeri -->
      <li class="menu-item {{ request()->is('admin/galeri*') ? 'active-custom' : '' }}">
          <a href="{{ route('dashboard.galeri.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-image"></i>
              <div class="text-truncate">Galeri</div>
          </a>
      </li>
  
      <!-- Artikel -->
      <li class="menu-item {{ request()->is('admin/artikel*') ? 'active-custom' : '' }}">
          <a href="{{ route('dashboard.artikel.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-news"></i>
              <div class="text-truncate">Artikel</div>
          </a>
      </li>
  
      <!-- User -->
      <li class="menu-item {{ request()->is('admin/user*') ? 'active-custom' : '' }}">
          <a href="{{ route('dashboard.user.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-user"></i>
              <div class="text-truncate">User</div>
          </a>
      </li>

      <!-- Contact Us -->
    <li class="menu-item {{ request()->is('admin/contact-us*') ? 'active-custom' : '' }}">
        <a href="{{ route('dashboard.contact_us.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-message-square-detail"></i>
            <div class="text-truncate">Contact Us</div>
        </a>
    </li>
  @endif
  
  <!-- Menu untuk Pimpinan -->
  @if (Auth::user()->role === 'Pimpinan')
      <!-- Laporan -->
      <li class="menu-item {{ request()->is('laporan*') ? 'active-custom' : '' }}">
          <a href="{{ route('laporan.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
              <div class="text-truncate">Laporan</div>
          </a>
      </li>
  @endif  

  </ul>
</aside>
