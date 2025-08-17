<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title', 'El Bakkah Travel')</title>
  <link rel="icon" href="{{ asset('img/favicon/favicon.ico') }}" type="image/x-icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- ICONS & FONTS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- BOOTSTRAP 5.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Jika pakai .ico -->
  <link rel="icon" href="{{ asset('img/favicon/favicon.ico') }}" type="image/x-icon">

  <!-- Custom Inline Styles -->
  <style>

.label-tipe-paket {
  position: absolute;
  top: 0;
  left: 0;
  padding: 6px 12px;
  font-size: 12px;
  font-weight: bold;
  color: white;
  background-color: #dc3545; /* default */
  clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%);
  z-index: 1;
  border-top-left-radius: 6px;
}

.icon-circle2 {
    width: 44px;
    height: 44px;
    background-color: #1AC9E0;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 18px;
  }

  .info-item {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    gap: 15px;
  }

  .info-item .text-muted {
    font-size: 0.9rem;
    margin-bottom: 4px;
  }

  .info-item .text-dark {
    font-weight: 600;
    font-size: 1rem;
  }

  .custom-card {
    border-radius: 14px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.06);
    border: none;
    background: #fff;
    padding: 24px;
  }

  .section-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #343a40;
    margin-bottom: 1rem;
    border-bottom: 2px solid #eee;
    padding-bottom: 6px;
  }

  .btn-reservasi {
    border-radius: 30px;
    font-weight: 600;
  }

  .other-paket-item {
    padding: 12px 0;
    border-bottom: 1px solid #eee;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .other-paket-item img {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
  }

  .other-paket-item:last-child {
    border-bottom: none;
  }

  .btn-wa {
    background-color: #25D366;
    color: white;
    font-weight: bold;
    font-size: 1rem;
    border-radius: 8px;
    transition: all 0.3s ease;
  }

  .btn-wa:hover {
    background-color: #1ebe5d;
  }

  .paket-link {
  color: #000000; /* warna hitam */
  font-weight: 600;
  text-decoration: none;
}

.paket-link:hover {
  text-decoration: underline;
}

/* Warna berdasarkan tipe */
.label-tipe-paket.promo {
  background-color: #dc3545;
}
.label-tipe-paket.reguler {
  background-color: #0d6efd;
}
.label-tipe-paket.gold {
  background-color: #ffc107;
}
.label-tipe-paket.ramadhan {
  background-color: #198754;
}
.label-tipe-paket.hemat {
  background-color: #cc26b9;
}

.label-tipe-sidebar {
  position: absolute;
  top: 5px;
  left: 5px;
  padding: 3px 8px;
  font-size: 10px;
  font-weight: 600;
  color: white;
  background-color: #198754;
  border-radius: 4px;
  z-index: 10;
}

.label-tipe-sidebar.ramadhan {
  background-color: #198754; /* Hijau */
}
.label-tipe-sidebar.reguler {
  background-color: #0d6efd; /* Biru */
}
.label-tipe-sidebar.gold {
  background-color: #ffc107; /* Kuning */
}
.label-tipe-sidebar.promo {
  background-color: #dc3545; /* Merah */
}

    .pagination .page-link {
        border-radius: 50% !important;
        width: 40px;
        height: 40px;
        line-height: 25px;
        text-align: center;
        padding: 8px;
        margin: 0 3px;
        border: 1px solid #ddd;
        color: #212529;
    }
    .pagination .page-item.active .page-link {
        background-color: #212529;
        color: #fff;
        border: 1px solid #212529;
    }
    .pagination .page-link:hover {
        background-color: #212529;
        color: #fff;
    }

    /* .section-title {
  font-size: 2rem;
  font-weight: bold;
  color: #0d6efd;
  position: relative;
}
.section-title::after {
  content: '';
  display: block;
  width: 60px;
  height: 3px;
  background: #ffc107;
  margin: 15px auto 0;
  border-radius: 2px;
} */

/* Melengkungkan sudut seluruh card */
.paket-card {
  border-radius: 1rem;
  overflow: hidden;
  transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.paket-card:hover {
  transform: translateY(-10px) scale(1.02);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

/* Melengkungkan gambar di atas */
.card-img-custom {
  height: 220px;
  object-fit: cover;
  width: 100%;
  border-top-left-radius: 1rem;
  border-top-right-radius: 1rem;
}

.nama-paket {
  font-size: 1.6rem;
  font-weight: 800;
  color: #1A1A1A;
  text-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
  letter-spacing: 0.5px;
}

.harga-text {
  font-size: 1rem;
  font-weight: 600;
  color: #444;
}

.info-text {
  font-size: 0.9rem;
  font-weight: 500;
  color: #333;
  white-space: nowrap;
  max-width: 50%;
  text-align: right;
}

.icon-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 3px 10px;
  border-radius: 999px;
  font-size: 0.82rem;
  font-weight: 600;
  border: 1px solid rgba(0, 0, 0, 0.05);
  background-color: #fdfdfd;
  min-width: 90px;
  height: 28px;
}

.icon-pill i {
  font-size: 1rem;
}

.icon-text {
  font-size: 0.85rem;
  margin-top: 1px;
}

.garis-halus {
  border: none;
  height: 1px;
  background-color: #e0e0e0;
  width: 100%;
}

.bg-soft-primary { background-color: rgba(26, 201, 224, 0.15); }
.bg-soft-danger  { background-color: rgba(220,53,69,0.1); }
.bg-soft-warning { background-color: rgba(255,193,7,0.15); }

.btn-detail-paket {
  background-color: #1AC9E0;
  color: #fff;
  font-weight: 600;
  padding: 10px 20px;
  border-radius: 30px;
  border: none;
  transition: all 0.3s ease-in-out;
  box-shadow: 0 5px 15px rgba(26, 201, 224, 0.4);
}
.btn-detail-paket:hover {
  background-color: #17a4ba;
  transform: scale(1.05);
  box-shadow: 0 8px 20px rgba(26, 201, 224, 0.6);
}

.form-group label {
    font-weight: 600;
  }

  .form-control:focus {
    border-color: #1AC9E0;
    box-shadow: 0 0 0 0.1rem rgba(26, 201, 224, 0.25);
  }

  .form-group:hover {
  box-shadow: 0 4px 12px rgba(0, 123, 255, 0.15);
  transition: all 0.2s ease-in-out;
}

  .form-field .icon {
    color: #aaa;
  }

  select.form-control, input.form-control {
    border-radius: 0.5rem;
  }

  .shadow-lg {
    box-shadow: 0 12px 45px rgba(0, 0, 0, 0.12) !important;
  }

  .btn-primary.shadow-sm {
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
    transition: box-shadow 0.3s ease;
  }

  .btn-primary.shadow-sm:hover {
    box-shadow: 0 6px 15px rgba(0, 123, 255, 0.5);
  }

  .card-gradient {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #1AC9E033; /* tipis dan elegan */
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  }

  .card-gradient:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(26, 201, 224, 0.15);
    border-color: #1AC9E0;
  }

  .icon-circle {
    width: 60px;
    height: 60px;
    margin: 0 auto;
    border-radius: 50%;
    background: linear-gradient(135deg, #1AC9E0 0%, #1ac9e029 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1AC9E0;
  }

  .icon-circle i {
    color: #1AC9E0;
  }

  .card-gradient h5 {
    margin-top: 12px;
  }
  .galeri-item {
    position: relative;
    background-size: cover;
    background-position: center;
    height: 300px;
    border-radius: 16px;
    overflow: hidden;
    cursor: pointer;
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .galeri-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.15);
  }

  .overlay-info {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0, 0, 50, 0.8), rgba(0, 0, 50, 0.1));
    color: #fff;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .galeri-item:hover .overlay-info {
    opacity: 1;
  }

  .judul {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 10px;
    color: #fff;
  }

  .deskripsi {
    font-size: 14px;
    color: #ddd;
    margin-bottom: 8px;
  }

  .tanggal {
    font-size: 13px;
    color: #ccc;
  }

  /* Lightbox */
  #lightbox {
    display: none;
    position: fixed;
    z-index: 1050;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.9);
    text-align: center;
    padding-top: 80px;
  }

  .lightbox-content {
    margin: auto;
    display: block;
    max-width: 80%;
    max-height: 80%;
    border-radius: 10px;
  }

  .close {
    position: absolute;
    top: 30px;
    right: 40px;
    color: white;
    font-size: 35px;
    font-weight: bold;
    cursor: pointer;
  }

  .close:hover {
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
  </style>
</head>

<body>

  {{-- Header --}}
  @include('pengguna.layouts.header')

  {{-- Main Content --}}
  <main>
    @yield('content')
  </main>

  {{-- Footer --}}
  @include('pengguna.layouts.footer')

  <!-- JS Libraries -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Bootstrap 5.3 Bundle JS (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Your App Scripts -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('js/scrollax.min.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="{{ asset('js/google-map.js') }}"></script>
  <script src="{{ asset('js/main2.js') }}"></script>

  @stack('scripts')

  <!-- Tooltip Init -->
  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
  </script>

</body>
</html>
