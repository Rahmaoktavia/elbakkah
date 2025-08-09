<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <title>El Bakkah Travel</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/css/pages/page-auth.css') }}" />

    <!-- Scripts -->
    <script src="{{ asset('vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>

    <style>
      :root {
        --bs-primary: #1AC9E0;
      }
      .btn-primary {
        background-color: #1AC9E0 !important;
        border-color: #1AC9E0 !important;
      }
      .btn-primary:hover {
        background-color: #18b0c7 !important;
        border-color: #18b0c7 !important;
      }
      .form-check-input:checked {
        background-color: #1AC9E0;
        border-color: #1AC9E0;
      }
      .link-primary, .forgot-link {
        color: #1AC9E0 !important;
        text-decoration: none;
      }
      .link-primary:hover, .forgot-link:hover {
        text-decoration: underline;
      }
      /* .form-label-capitalize {
        text-transform: capitalize;
        font-weight: 500;
      } */
      .app-brand img {
        height: 80px;
        margin-bottom: 6px;
      }
      input.form-control:focus,
      .input-group .form-control:focus {
        border-color: #1AC9E0;
        box-shadow: 0 0 0 0.2rem rgba(26, 201, 224, 0.25);
      }
      .input-group:focus-within .input-group-text {
        border-color: #1AC9E0 !important;
        box-shadow: 0 0 0 0.2rem rgba(26, 201, 224, 0.25);
      }
      .input-group-text {
        border-color: #d9dee3;
        background-color: #fff;
        transition: all 0.2s ease-in-out;
      }
      .text-brand-title {
        margin-top: -0.3rem;
        margin-bottom: 1.2rem;
        font-weight: 600;
      }
    </style>
  </head>

  <body>
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Login Card -->
          <div class="card">
            <div class="card-body">
              <div class="app-brand justify-content-center mb-2">
                <img src="{{ asset('img/icons/brands/elbakkah.png') }}" alt="El Bakkah Logo">
              </div>

              <h4 class="text-center text-brand-title">El Bakkah Travel</h4>

              @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
              @endif

              <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                  <label for="email" class="form-label form-label-capitalize">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror"
                         id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required autofocus />
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label form-label-capitalize" for="password">Password</label>
                    <a href="#" class="forgot-link"><small>Lupa password?</small></a>
                  </div>
                  <div class="input-group input-group-merge" id="toggle-password">
                    <input
                      type="password"
                      id="password"
                      class="form-control @error('password') is-invalid @enderror"
                      name="password"
                      placeholder="Masukkan password"
                      required />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                  @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember" />
                    <label class="form-check-label" for="remember">Ingat saya</label>
                  </div>
                </div>

                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                </div>
              </form>

              <p class="text-center">
                <span>Belum punya akun?</span>
                <a href="{{ route('register') }}" class="link-primary"><span>Buat akun baru</span></a>
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

    <!-- Toggle Show/Hide Password -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const toggleIcon = document.getElementById('toggle-icon');
        const passwordInput = document.getElementById('password');

        toggleIcon.addEventListener('click', function () {
          const isPassword = passwordInput.type === 'password';
          passwordInput.type = isPassword ? 'text' : 'password';
          toggleIcon.classList.toggle('bx-hide', !isPassword);
          toggleIcon.classList.toggle('bx-show', isPassword);
        });
      });
    </script>
  </body>
</html>
