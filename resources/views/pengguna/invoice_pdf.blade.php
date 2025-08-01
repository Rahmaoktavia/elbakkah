<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice Pembayaran</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; margin: 0; padding: 20px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 8px 12px; border: 1px solid #ddd; text-align: left; }
        .no-border { border: none; }
        .text-right { text-align: right; }
        .summary-table { margin-top: 30px; }
    </style>
</head>
<body>
    <h2>INVOICE PEMBAYARAN UMRAH</h2>

    <table>
        <tr>
            <th>Nama Jamaah</th>
            <td>{{ $pembayaran->pemesanan->jamaah->nama_jamaah }}</td>
        </tr>
        <tr>
            <th>Nomor Pemesanan</th>
            <td>{{ $pembayaran->pemesanan->id }}</td>
        </tr>
        <tr>
            <th>Tanggal Pembayaran</th>
            <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <th>Jumlah Pembayaran</th>
            <td>Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Status Verifikasi</th>
            <td>{{ $pembayaran->status_verifikasi }}</td>
        </tr>
    </table>

    <table class="summary-table">
        <tr>
            <th>Total Tagihan</th>
            <td class="text-right">Rp {{ number_format($pembayaran->pemesanan->total_tagihan, 0, ',', '.') }}</td>
        </tr>
        <tr>
        <th>Total Sudah Dibayar</th>
        <td class="text-right">
            Rp {{
                number_format(
                    $pembayaran->pemesanan->pembayarans->sum('jumlah_bayar'), 0, ',', '.'
                )
            }}
        </td>
    </tr>
        {{-- Sisa Angsuran --}}
        <tr>
            <th>Sisa Angsuran</th>
            <td class="text-right">
                Rp {{
                    number_format(
                        $pembayaran->pemesanan->total_tagihan -
                        $pembayaran->pemesanan->pembayarans->sum('jumlah_bayar'), 0, ',', '.'
                    )
                }}
            </td>
        </tr>
    </table>

    <p style="margin-top: 40px;">Terima kasih telah melakukan pembayaran. Simpan invoice ini sebagai bukti pembayaran resmi.</p>
</body>
</html>
