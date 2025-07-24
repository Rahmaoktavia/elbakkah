<!-- header.blade.php -->
<div class="row mb-4">
  <div class="col-12">
    <div class="card">
      <div class="card-body p-3 pb-2">
        <nav class="layout-navbar navbar navbar-expand-xl align-items-center" id="layout-navbar">
          <!-- Tombol toggle menu (jika layar kecil) -->
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="icon-base bx bx-menu icon-md"></i>
            </a>
          </div>

          <!-- Bagian kanan navbar (user dropdown + role badge) -->
          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item d-flex align-items-center me-2">
              <div class="avatar avatar-online me-2">
                <img src="{{ Auth::user()->foto_profil ? asset('storage/foto_profil/' . Auth::user()->foto_profil) : asset('img/avatars/1.png') }}" alt="User" class="w-px-40 h-auto rounded-circle" />
              </div>
              <span class="badge" style="background-color: #1AC9E0; text-transform: capitalize;">
                {{ strtolower(Auth::user()->role) }}
              </span>
            </li>

            <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a class="nav-link dropdown-toggle hide-arrow p-0" href="#" data-bs-toggle="dropdown">
                <i class="bx bx-chevron-down fs-4"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <!-- Profil info -->
                <li class="px-3 py-2">
                  <div class="d-flex align-items-center">
                    <div class="avatar me-3">
                      <img src="{{ Auth::user()->foto_profil ? asset('storage/foto_profil/' . Auth::user()->foto_profil) : asset('img/avatars/1.png') }}" alt="User" class="w-px-40 h-auto rounded-circle" />
                    </div>
                    <div>
                      <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                    </div>
                  </div>
                </li>

                <li><hr class="dropdown-divider my-1" /></li>

                <!-- Logout pakai SweetAlert2 -->
                <li>
                  <a class="dropdown-item" href="javascript:void(0)" onclick="swalLogout()">
                    <i class="bx bx-power-off me-2"></i> Logout
                  </a>
                </li>
              </ul>
            </li>
          </ul>

          <!-- Form logout tersembunyi -->
          <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
            @csrf
          </form>
        </nav>
      </div>
    </div>
  </div>
</div>

<!-- Script SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function swalLogout() {
    Swal.fire({
      title: 'Yakin ingin logout?',
      text: 'Kamu akan keluar dari akun El-Bakkah Travel.',
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
    })
  }
</script>
