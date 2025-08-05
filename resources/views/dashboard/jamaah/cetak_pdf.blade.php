<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Jamaah</title>
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

        .thumb {
            max-width: 60px;
            max-height: 60px;
            border: 1px solid #aaa;
            padding: 1px;
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
    <h3 class="judul">Laporan Data Jamaah</h3>

    <!-- Tabel Jamaah -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>TTL</th>
                <th>Umur</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Ayah</th>
                <th>Pekerjaan</th>
                <th>Pas Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jamaahs as $index => $jamaah)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $jamaah->nama_jamaah }}</td>
                    <td>{{ $jamaah->nik }}</td>
                    <td>{{ $jamaah->tempat_lahir }}, {{ \Carbon\Carbon::parse($jamaah->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                    <td class="text-center">{{ $jamaah->umur }} tahun</td> 
                    <td class="text-center">{{ $jamaah->jenis_kelamin }}</td>
                    <td>{{ $jamaah->alamat }}</td>
                    <td>{{ $jamaah->no_telepon }}</td>
                    <td>{{ $jamaah->nama_ayah }}</td>
                    <td>{{ $jamaah->pekerjaan }}</td>
                    <td class="text-center">
                        @php
                            $fotoPath = public_path('img/' . $jamaah->pas_foto);
                            $fotoData = file_exists($fotoPath) ? base64_encode(file_get_contents($fotoPath)) : null;
                        @endphp
                        @if ($fotoData)
                            <img src="data:image/jpeg;base64,{{ $fotoData }}" class="thumb">
                        @else
                            <span style="color: red;">Tidak Ada</span>
                        @endif
                    </td>
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
