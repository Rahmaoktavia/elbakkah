<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Galeri</title>
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
            font-size: 12px;
        }

        th, td {
            border: 1px solid #444;
            padding: 8px;
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
            max-width: 80px;
            max-height: 60px;
            border: 1px solid #aaa;
            padding: 2px;
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
    <h3 class="judul">Laporan Galeri El-Bakkah Travel</h3>

    <!-- Tabel Galeri -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Foto</th>
                <th>Deskripsi</th>
                <th>Tanggal Upload</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($galeris as $index => $galeri)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $galeri->judul_foto }}</td>
                    <td>{{ $galeri->deskripsi ?? '-' }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($galeri->tanggal_upload)->format('d-m-Y') }}</td>
                    <td class="text-center">
                        @php
                            $imagePath = public_path('img/' . $galeri->file_foto);
                            $imageData = file_exists($imagePath) ? base64_encode(file_get_contents($imagePath)) : null;
                        @endphp
                        @if ($imageData)
                            <img src="data:image/jpeg;base64,{{ $imageData }}" alt="foto" class="thumb">
                        @else
                            <span style="color: red;">Tidak ada foto</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer Tanggal Cetak -->
    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y') }}
    </div>

</body>
</html>
