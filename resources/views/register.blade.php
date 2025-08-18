<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <title>El Bakkah Travel</title>

  <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.ico') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('vendor/fonts/boxicons.css') }}" />
  <link rel="stylesheet" href="{{ asset('vendor/css/core.css') }}" />
  <link rel="stylesheet" href="{{ asset('vendor/css/theme-default.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />
  <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
  <link rel="stylesheet" href="{{ asset('vendor/css/pages/page-auth.css') }}" />
  <script src="{{ asset('vendor/js/helpers.js') }}"></script>
  <script src="{{ asset('js/config.js') }}"></script>

  <style>
    :root { --bs-primary: #1AC9E0; }

    .form-label-capitalize { text-transform: capitalize; font-weight: 500; }

    .btn-primary {
      background-color: #1AC9E0 !important;
      border-color: #1AC9E0 !important;
    }

    .btn-primary:hover {
      background-color: #18b0c7 !important;
      border-color: #18b0c7 !important;
    }

    .link-primary { color: #1AC9E0 !important; text-decoration: none; }
    .link-primary:hover { text-decoration: underline; }

    .form-check-input:checked {
      background-color: #1AC9E0;
      border-color: #1AC9E0;
    }

    .app-brand img { height: 80px; margin-bottom: 6px; }

    input.form-control:focus,
    .input-group:focus-within .form-control {
      border-color: #1AC9E0;
      box-shadow: 0 0 0 0.2rem rgba(26, 201, 224, 0.25);
    }

    .input-group-text {
      border-color: #d9dee3;
      background-color: #fff;
      transition: all 0.2s ease-in-out;
    }

    .input-group:focus-within .input-group-text {
      border-color: #1AC9E0;
      box-shadow: 0 0 0 0.2rem rgba(26, 201, 224, 0.25);
    }

    .text-brand-title {
      margin-top: -0.3rem;
      margin-bottom: 1.2rem;
      font-weight: 600;
    }

    .authentication-wrapper::before {
      background-image: radial-gradient(#1AC9E0 1px, transparent 1px);
    }

    .captcha-img {
      display: block;
      margin-bottom: 0.5rem;
    }

    .reload-btn {
      font-size: 0.85rem;
      color: #1AC9E0;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <div class="card">
          <div class="card-body">

            <!-- Logo -->
            <div class="app-brand justify-content-center" style="margin-bottom: 0.3rem;">
              <img src="{{ asset('img/icons/brands/elbakkah.png') }}" alt="El Bakkah Logo">
            </div>
            <h4 class="text-center text-brand-title">El Bakkah Travel</h4>

            <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('register') }}">
              @csrf

              <div class="mb-3">
                <label for="name" class="form-label form-label-capitalize">Nama lengkap</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required />
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
              </div>

              <div class="mb-3">
                <label for="username" class="form-label form-label-capitalize">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" value="{{ old('username') }}" required />
                @error('username') <small class="text-danger">{{ $message }}</small> @enderror
              </div>

              <div class="mb-3">
                <label for="email" class="form-label form-label-capitalize">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" required />
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
              </div>

              <div class="mb-3 form-password-toggle">
                <label for="password" class="form-label form-label-capitalize">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="Masukkan password" required />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
              </div>

              <div class="mb-3 form-password-toggle">
                <label for="password_confirmation" class="form-label form-label-capitalize">Konfirmasi password</label>
                <div class="input-group input-group-merge">
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Masukkan konfirmasi password" required />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>

              <div class="mb-3">
                <label for="captcha" class="form-label form-label-capitalize">Captcha</label>
                <div class="captcha-img">
                  {!! captcha_img('flat') !!}
                </div>
                <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Masukkan jawaban" required />
                @error('captcha') <small class="text-danger">{{ $message }}</small> @enderror
              </div>

              <button type="submit" class="btn btn-primary d-grid w-100">Daftar</button>
            </form>

            <p class="text-center">
              <span>Sudah punya akun?</span>
              <a href="{{ route('login') }}" class="link-primary"><span>Login di sini</span></a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Core JS -->
  <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('vendor/js/menu.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>

  <!-- Reload Captcha JS -->
  <script>
    function reloadCaptcha() {
      fetch('/captcha/refresh')
        .then(res => res.text())
        .then(data => {
          document.querySelector('.captcha-img').innerHTML = data + '<div class="reload-btn" onclick="reloadCaptcha()">↻ Ganti captcha</div>';
        });
    }
  </script>
</body>
</html>
