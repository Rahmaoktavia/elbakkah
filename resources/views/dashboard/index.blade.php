@extends('dashboard.layouts.main')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">

    <!-- 4 Kartu Atas -->
    <div class="row g-4 mb-4">
      <!-- Total Paket Umrah -->
      <div class="col-xl-3 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-4">
              <div class="avatar flex-shrink-0 bg-label-primary rounded">
                <i class="fas fa-kaaba fs-3 text-primary"></i>
              </div>
            </div>
            <p class="mb-1">Total Paket Umrah</p>
            <h4 class="card-title mb-0">{{ $totalPaket }}</h4>
          </div>
        </div>
      </div>

      <!-- Total Jamaah -->
      <div class="col-xl-3 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-4">
              <div class="avatar flex-shrink-0 bg-label-success rounded">
                <i class="fas fa-users fs-3 text-success"></i>
              </div>
            </div>
            <p class="mb-1">Total Jamaah</p>
            <h4 class="card-title mb-0">{{ $totalJamaah }}</h4>
          </div>
        </div>
      </div>

      <!-- Total Pemesanan -->
      <div class="col-xl-3 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-4">
              <div class="avatar flex-shrink-0 bg-label-warning rounded">
                <i class="fas fa-clipboard-list fs-3 text-warning"></i>
              </div>
            </div>
            <p class="mb-1">Total Pemesanan</p>
            <h4 class="card-title mb-0">{{ $totalPemesanan }}</h4>
          </div>
        </div>
      </div>

      <!-- Total Distribusi -->
      <div class="col-xl-3 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-4">
              <div class="avatar flex-shrink-0 bg-label-info rounded">
                <i class="fas fa-dolly fs-3 text-info"></i>
              </div>
            </div>
            <p class="mb-1">Total Distribusi</p>
            <h4 class="card-title mb-0">{{ $totalDistribusi }}</h4>
          </div>
        </div>
      </div>
    </div> <!-- Akhir dari row g-4 -->

    <!-- Laporan Pembayaran & Paket Umrah Terlaris dalam satu baris -->
    <div class="row g-4">
      <!-- Laporan Pembayaran (grafik garis) -->
      <div class="col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title">Laporan Pembayaran</h5>
            <canvas id="paymentChart"></canvas>
          </div>
        </div>
      </div>

      <!-- Paket Umrah Terlaris -->
      <div class="col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title">Paket Umrah Terlaris</h5>
            <div class="row">
              @foreach ($topPaket as $paket)
                <div class="col-md-12 mb-3">
                  <div class="d-flex align-items-center border rounded p-2">
                    <img src="{{ asset('img/' . $paket->gambar_paket) }}" alt="Gambar Paket" class="me-3 rounded" style="width: 80px; height: 80px; object-fit: cover;">
                    <div class="flex-grow-1">
                      <h6 class="mb-1">{{ $paket->nama_paket }}</h6>
                      <span class="badge bg-primary">{{ $paket->pemesanan_count }} pemesanan</span>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div> <!-- Akhir row grafik & terlaris -->

  </div>
</div>

<!-- Chart.js CDN & Line Chart Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('paymentChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'],
      datasets: [{
        label: 'Pembayaran (Rp)',
        data: [12000000, 15000000, 9000000, 17000000, 21000000],
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 2,
        fill: true,
        tension: 0.4
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top'
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
@endsection
