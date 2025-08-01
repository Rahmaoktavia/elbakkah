<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\Jamaah;
use App\Models\PaketUmrah;
use App\Models\InventarisPerlengkapan;
use App\Models\DistribusiPerlengkapan;
use App\Models\JadwalKeberangkatan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPimpinanController extends Controller
{
    public function cetakPembayaran(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $query = Pembayaran::with(['pemesanan.jamaah', 'pemesanan.jadwalKeberangkatan.paket']);

        if ($bulan) {
            $query->whereMonth('tanggal_bayar', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tanggal_bayar', $tahun);
        }

        $pembayarans = $query->get();

        $pdf = Pdf::loadView('dashboard.laporan.pembayaran', compact('pembayarans', 'bulan', 'tahun'))
                    ->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-pembayaran.pdf');
    }

    public function cetakPemesanan(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
    
        $query = Pemesanan::with(['jamaah', 'jadwalKeberangkatan.paket']);
    
        if ($bulan) {
            $query->whereMonth('tanggal_pesan', $bulan);
        }
    
        if ($tahun) {
            $query->whereYear('tanggal_pesan', $tahun);
        }
    
        $pemesanans = $query->get();
    
        $pdf = Pdf::loadView('dashboard.laporan.pemesanan', compact('pemesanans', 'bulan', 'tahun'))
                    ->setPaper('A4', 'portrait');
    
        return $pdf->stream('laporan-pemesanan.pdf');
    }
    

    public function cetakJamaah()
    {
        $jamaahs = Jamaah::with('user')->get();

        $pdf = Pdf::loadView('dashboard.laporan.jamaah', compact('jamaahs'));
        return $pdf->stream('laporan-jamaah.pdf');
    }

    public function cetakInventaris()
    {
        $inventaris = InventarisPerlengkapan::all();

        $pdf = Pdf::loadView('dashboard.laporan.inventaris', compact('inventaris'));
        return $pdf->stream('laporan-inventaris.pdf');
    }

    public function cetakPaket()
    {
        $paketUmrahs = PaketUmrah::all();

        $pdf = Pdf::loadView('dashboard.laporan.paket', compact('paketUmrahs'));
        return $pdf->stream('laporan-paket-umrah.pdf');
    }

    public function cetakJadwal()
    {
        $jadwals = JadwalKeberangkatan::with('paket')->get();

        $pdf = Pdf::loadView('dashboard.laporan.jadwal', compact('jadwals'));
        return $pdf->stream('laporan-jadwal-keberangkatan.pdf');
    }

    public function cetakDistribusi()
    {
        $distribusi = DistribusiPerlengkapan::with(['jamaah.user', 'perlengkapan'])->get();
        
        $pdf = Pdf::loadView('dashboard.laporan.distribusi', compact('distribusi'));
        return $pdf->stream('laporan-distribusi-perlengkapan.pdf');
    }
}
