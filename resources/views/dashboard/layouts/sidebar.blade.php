<aside id="layout-menu"
  class="layout-menu menu-vertical menu bg-white shadow-sm border-end"
  style="height: 100vh; border-radius: 0;">

    <!-- Logo El-Bakkah + Nama -->
    <div class="app-brand d-flex align-items-center px-3 py-3">
        <img src="{{ asset('img/icons/brands/el-bakkah.png') }}"
            alt="Logo El-Bakkah"
            style="height: 48px; width: auto; object-fit: contain; margin-right: 12px;">

        <span class="fw-bold text-dark fs-5 text-wrap" style="line-height: 1.3;">
            El-Bakkah Travel Umrah
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

    <!-- Menu khusus untuk ADMIN -->
    @if (Auth::user()->role === 'Admin')
         <!-- Paket Umrah -->
        <li class="menu-item {{ request()->is('admin/paket*') ? 'active-custom' : '' }}">
            <a href="{{ route('dashboard.paket.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-briefcase-alt"></i>
                <div class="text-truncate">Paket Umrah</div>
            </a>
        </li>

        <!-- Jadwal Keberangkatan -->
        <li class="menu-item {{ request()->is('admin/jadwal*') ? 'active-custom' : '' }}">
            <a href="{{ route('dashboard.jadwal.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div class="text-truncate">Jadwal Keberangkatan</div>
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

    @endif

    <!-- Menu untuk semua pengguna -->
    <li class="menu-item {{ request()->is('email') ? 'active-custom' : '' }}">
      <a href="#" class="menu-link">
        <i class="menu-icon tf-icons bx bx-envelope"></i>
        <div class="text-truncate">Jamaah</div>
      </a>
    </li>

    <li class="menu-item {{ request()->is('chat') ? 'active-custom' : '' }}">
      <a href="#" class="menu-link">
        <i class="menu-icon tf-icons bx bx-chat"></i>
        <div class="text-truncate">Pemesanan</div>
      </a>
    </li>

    <li class="menu-item {{ request()->is('calendar') ? 'active-custom' : '' }}">
      <a href="#" class="menu-link">
        <i class="menu-icon tf-icons bx bx-calendar"></i>
        <div class="text-truncate">Pembayaran</div>
      </a>
    </li>

    <li class="menu-item {{ request()->is('kanban') ? 'active-custom' : '' }}">
      <a href="#" class="menu-link">
        <i class="menu-icon tf-icons bx bx-grid"></i>
        <div class="text-truncate">Inventaris</div>
      </a>
    </li>

    <li class="menu-item {{ request()->is('settings') ? 'active-custom' : '' }}">
      <a href="#" class="menu-link">
        <i class="menu-icon tf-icons bx bx-dock-top"></i>
        <div class="text-truncate">Distribusi</div>
      </a>
    </li>

    <li class="menu-item {{ request()->is('auth') ? 'active-custom' : '' }}">
      <a href="#" class="menu-link">
        <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
        <div class="text-truncate">User</div>
      </a>
    </li>

  </ul>
</aside>
