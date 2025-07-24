@extends('dashboard.layouts.main')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">

    <!-- 4 Kartu Atas -->
    <div class="row g-4 mb-4">
      <!-- Profit -->
      <div class="col-xl-3 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-4">
              <div class="avatar flex-shrink-0">
                <img src="{{ asset('img/icons/unicons/chart-success.png') }}" alt="Profit" class="rounded">
              </div>
            </div>
            <p class="mb-1">Profit</p>
            <h4 class="card-title mb-3">$12,628</h4>
            <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
          </div>
        </div>
      </div>

      <!-- Sales -->
      <div class="col-xl-3 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-4">
              <div class="avatar flex-shrink-0">
                <img src="{{ asset('img/icons/unicons/wallet-info.png') }}" alt="Sales" class="rounded">
              </div>
            </div>
            <p class="mb-1">Sales</p>
            <h4 class="card-title mb-3">$4,679</h4>
            <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
          </div>
        </div>
      </div>

      <!-- Payments -->
      <div class="col-xl-3 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-4">
              <div class="avatar flex-shrink-0">
                <img src="{{ asset('img/icons/unicons/paypal.png') }}" alt="Payments" class="rounded">
              </div>
            </div>
            <p class="mb-1">Payments</p>
            <h4 class="card-title mb-3">$2,456</h4>
            <small class="text-danger fw-medium"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>
          </div>
        </div>
      </div>

      <!-- Transactions -->
      <div class="col-xl-3 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-4">
              <div class="avatar flex-shrink-0">
                <img src="{{ asset('img/icons/unicons/cc-primary.png') }}" alt="Transactions" class="rounded">
              </div>
            </div>
            <p class="mb-1">Transactions</p>
            <h4 class="card-title mb-3">$14,857</h4>
            <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
          </div>
        </div>
      </div>
    </div>

    <!-- Profile Report -->
    <div class="row g-4 mb-4">
      <div class="col-12">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between flex-wrap flex-sm-nowrap">
              <div>
                <h5 class="mb-1">Profile Report</h5>
                <span class="badge bg-label-warning">YEAR 2022</span>
              </div>
              <div class="text-end mt-3 mt-sm-0">
                <span class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> 68.2%</span>
                <h4 class="mb-0">$84,686k</h4>
              </div>
            </div>
            <div id="profileReportChart" class="mt-4" style="min-height: 75px;">
              <!-- Chart inject here -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Revenue -->
    <div class="row g-4">
      <div class="col-12">
        <div class="card">
          <div class="row g-0">
            <!-- Chart Side -->
            <div class="col-lg-8">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">Total Revenue</h5>
                <div class="dropdown">
                  <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">Select All</a>
                    <a class="dropdown-item" href="#">Refresh</a>
                    <a class="dropdown-item" href="#">Share</a>
                  </div>
                </div>
              </div>
              <div id="totalRevenueChart" class="px-3" style="min-height: 315px;"></div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
              <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <div class="text-center mb-4">
                  <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary">2024</button>
                    <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                      <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">2021</a></li>
                      <li><a class="dropdown-item" href="#">2020</a></li>
                      <li><a class="dropdown-item" href="#">2019</a></li>
                    </ul>
                  </div>
                </div>
                <div id="growthChart" style="min-height: 142px;"></div>
                <div class="text-center fw-medium my-4">62% Company Growth</div>

                <div class="d-flex gap-3 w-100 justify-content-between">
                  <div class="d-flex align-items-center">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded-2 bg-label-primary">
                        <i class="bx bx-dollar icon-lg text-primary"></i>
                      </span>
                    </div>
                    <div>
                      <small>2024</small>
                      <h6 class="mb-0">$32.5k</h6>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded-2 bg-label-info">
                        <i class="bx bx-wallet icon-lg text-info"></i>
                      </span>
                    </div>
                    <div>
                      <small>2023</small>
                      <h6 class="mb-0">$41.2k</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div> <!-- col-lg-4 -->
          </div> <!-- row -->
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
