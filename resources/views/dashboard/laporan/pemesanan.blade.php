<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pemesanan</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            color: #000;
            margin: 40px;
        }

        .kop-surat {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 25px;
        }

        .kop-surat img {
            width: 80px;
            height: 80px;
            margin-right: 15px;
        }

        .kop-surat .info {
            text-align: left;
        }

        .kop-surat .info h2 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
        }

        .kop-surat .info p {
            margin: 0;
            font-size: 12px;
        }

        h3.judul {
            text-align: center;
            font-size: 16px;
            text-transform: uppercase;
            margin-top: 0;
            margin-bottom: 5px;
        }

        hr.judul-line {
            width: 200px;
            border: 1px solid #000;
            margin: 5px auto 20px auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 11px;
        }

        th, td {
            border: 1px solid #444;
            padding: 6px;
            vertical-align: top;
        }

        th {
            background-color: #f0f0f0;
            text-align: center;
            font-weight: bold;
        }

        td.text-center {
            text-align: center;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <!-- Kop Surat -->
    <div class="kop-surat">
        <img src="{{ public_path('img/icons/brands/el-bakkah.png') }}" alt="Logo El-Bakkah">
        <div class="info">
            <h2>EL-BAKKAH TRAVEL</h2>
            <p>Jl. Lolong Karan no. 14 C, Sungai Sapih, Kec. Kuranji, Sumatera Barat 25173</p>
            <p>Telp: +62 822-8600-3630 | Email: elbakkah4@gmail.com</p>
        </div>
    </div>

    <!-- Judul -->
    <h3 class="judul">Laporan Data Pemesanan Umrah</h3>

    <!-- Periode Filter -->
    @if (isset($bulan) || isset($tahun))
    <p style="text-align:center; font-size: 12px; margin-top: 0;">
        Periode:
        @if ($bulan)
            {{ \Carbon\Carbon::create()->month((int) $bulan)->translatedFormat('F') }}
        @endif
        {{ $tahun }}
    </p>
@else
    <p style="text-align:center; font-size: 12px; margin-top: 0;">
        Periode: Semua Data
    </p>
@endif

    <!-- Tabel Pemesanan -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jamaah</th>
                <th>Nama Paket</th>
                <th>Tanggal Keberangkatan</th>
                <th>Tanggal Pemesanan</th>
                <th>Total Tagihan</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemesanans as $index => $pemesanan)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $pemesanan->jamaah->nama_jamaah ?? '-' }}</td>
                    <td>{{ $pemesanan->jadwalKeberangkatan->paket->nama_paket ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($pemesanan->jadwalKeberangkatan->tanggal_berangkat)->translatedFormat('d F Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal_pesan)->translatedFormat('d F Y') }}</td>
                    <td>Rp {{ number_format($pemesanan->total_tagihan, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $pemesanan->status_pembayaran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </div>

</body>
</html>
