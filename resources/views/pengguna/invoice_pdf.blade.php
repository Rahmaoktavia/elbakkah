<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Pembayaran Umrah</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            color: #000;
            margin: 40px;
        }

        .kop-surat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 25px;
        }

        .kop-left {
            display: flex;
            align-items: center;
        }

        .kop-left img {
            width: 80px;
            height: 80px;
            margin-right: 15px;
        }

        .kop-left .info h2 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
        }

        .kop-left .info p {
            margin: 0;
            font-size: 12px;
        }

        .invoice-label {
            font-size: 28px;
            font-weight: bold;
            color: #1AC9E0;
            text-align: right;
        }

        .info-pemesanan {
            margin-bottom: 20px;
            display: table;
        }

        .info-pemesanan .row {
            display: table-row;
        }

        .info-pemesanan .label, .info-pemesanan .colon, .info-pemesanan .value {
            display: table-cell;
            padding: 2px 4px;
        }

        .colon {
            width: 10px;
        }

        .separator {
            border-top: 1px solid #999;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #444;
            padding: 8px;
            vertical-align: top;
        }

        th {
            background-color: #1AC9E0;
            color: #fff;
            text-align: center;
            font-weight: bold;
        }

        td.text-center {
            text-align: center;
        }

        .summary {
            margin-top: 30px;
            font-size: 12px;
            width: 100%;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #ccc;
            padding: 6px 0;
        }

        .summary-row strong {
            font-weight: bold;
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
        <div class="kop-left">
            <img src="{{ public_path('img/icons/brands/el-bakkah.png') }}" alt="Logo El-Bakkah">
            <div class="info">
                <h2>EL-BAKKAH TRAVEL</h2>
                <p>Jl. Lolong Karan no. 14 C, Sungai Sapih, Kec. Kuranji, Sumatera Barat 25173</p>
                <p>Telp: +62 822-8600-3630 | Email: elbakkah4@gmail.com</p>
                <div class="invoice-label">INVOICE</div>
            </div>
        </div>
    </div>

    <!-- Info Pemesanan -->
    <div class="info-pemesanan">
        <div class="row">
            <div class="label"><strong>Nama Jamaah</strong></div>
            <div class="colon">:</div>
            <div class="value">{{ $pemesanan->jamaah->nama_jamaah }}</div>
        </div>
        <div class="row">
            <div class="label"><strong>Nomor Pemesanan</strong></div>
            <div class="colon">:</div>
            <div class="value">{{ $pemesanan->id }}</div>
        </div>
        <div class="row">
            <div class="label"><strong>Nama Paket</strong></div>
            <div class="colon">:</div>
            <div class="value">{{ $pemesanan->jadwalKeberangkatan->paket->nama_paket }}</div>
        </div>
        <div class="row">
            <div class="label"><strong>Jadwal Keberangkatan</strong></div>
            <div class="colon">:</div>
            <div class="value">{{ \Carbon\Carbon::parse($pemesanan->jadwalKeberangkatan->tanggal_berangkat)->translatedFormat('d F Y') }}</div>
        </div>
    </div>


    <!-- Tabel Pembayaran -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pembayaran</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemesanan->pembayarans as $i => $p)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($p->tanggal_bayar)->translatedFormat('d F Y') }}</td>
                <td>Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                <td>{{ $p->status_verifikasi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Ringkasan -->
    <div class="summary">
        <div class="summary-row">
            <strong>Total Tagihan</strong>
            <strong>Rp {{ number_format($pemesanan->total_tagihan, 0, ',', '.') }}</strong>
        </div>
        <div class="summary-row">
            <strong>Total Dibayar</strong>
            <strong>Rp {{ number_format($totalBayar, 0, ',', '.') }}</strong>
        </div>
        <div class="summary-row">
            <strong>Sisa Pembayaran</strong>
            <strong>Rp {{ number_format($pemesanan->total_tagihan - $totalBayar, 0, ',', '.') }}</strong>
        </div>
        <div class="summary-row">
            <strong>Status Pembayaran</strong>
            <strong style="color: {{ $pemesanan->status_pembayaran == 'Lunas' ? 'green' : '#e6a700' }}">
                {{ $pemesanan->status_pembayaran }}
            </strong>
        </div>
    </div>

    <!-- Footer -->
    <p class="footer">Padang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
</body>
</html>
