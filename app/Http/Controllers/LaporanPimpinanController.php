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
use Carbon\Carbon;

class LaporanPimpinanController extends Controller
{
    public function indexLaporan()
    {
        $namaPerlengkapanList = InventarisPerlengkapan::select('nama_perlengkapan')->distinct()->pluck('nama_perlengkapan');
        $namaPaketList = PaketUmrah::select('nama_paket')->distinct()->pluck('nama_paket');

        return view('dashboard.laporan.index', compact('namaPerlengkapanList', 'namaPaketList'));
    }

    public function cetakPembayaran(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $status = $request->status;

        $query = Pembayaran::with(['pemesanan.jamaah', 'pemesanan.jadwalKeberangkatan.paket']);

        if ($bulan) {
            $query->whereMonth('tanggal_bayar', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tanggal_bayar', $tahun);
        }

        if ($status) {
            $query->where('status_verifikasi', $status);
        }

        $pembayarans = $query->get();

        $pdf = Pdf::loadView('dashboard.laporan.pembayaran', compact('pembayarans', 'bulan', 'tahun', 'status'))
                    ->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-pembayaran.pdf');
    }

    public function cetakPemesanan(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $status = $request->status_pembayaran;

        $query = Pemesanan::with(['jamaah', 'jadwalKeberangkatan.paket']);

        if ($bulan) {
            $query->whereMonth('tanggal_pesan', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tanggal_pesan', $tahun);
        }

        if ($status) {
            $query->where('status_pembayaran', $status);
        }

        $pemesanans = $query->get();

        $pdf = Pdf::loadView('dashboard.laporan.pemesanan', compact('pemesanans', 'bulan', 'tahun', 'status'))
                    ->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-pemesanan.pdf');
    }
    
    public function cetakJamaah(Request $request)
    {
        $jenis_kelamin = $request->jenis_kelamin;
        $tahun = $request->tahun;

        $query = Jamaah::query();

        if ($jenis_kelamin) {
            $query->where('jenis_kelamin', $jenis_kelamin);
        }

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        $jamaahs = $query->get();

        $pdf = Pdf::loadView('dashboard.laporan.jamaah', compact('jamaahs', 'jenis_kelamin', 'tahun'));
        return $pdf->stream('laporan-jamaah.pdf');
    }

    public function cetakInventaris(Request $request)
    {
        $query = InventarisPerlengkapan::query();

        if ($request->filled('bulan') && $request->filled('tahun')) {
            $query->whereMonth('tanggal_input', $request->bulan)
                ->whereYear('tanggal_input', $request->tahun);
        }

        if ($request->filled('nama_perlengkapan')) {
            $query->where('nama_perlengkapan', $request->nama_perlengkapan);
        }

        $inventaris = $query->get();

        $pdf = Pdf::loadView('dashboard.laporan.inventaris', [
            'inventaris' => $inventaris,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'nama_perlengkapan' => $request->nama_perlengkapan,
        ]);

        return $pdf->stream('laporan-inventaris.pdf');
    }

    public function cetakPaketDenganJamaah(Request $request)
    {
        $query = PaketUmrah::with(['pemesanan.jamaah']);

        if ($request->nama_paket) {
            $query->where('nama_paket', $request->nama_paket);
        }

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $paketUmrahs = $query->get()->map(function ($paket) use ($bulan, $tahun) {
            $paket->filteredPemesanans = $paket->pemesanan->filter(function ($p) use ($bulan, $tahun) {
                $tanggal = Carbon::parse($p->created_at);
                $matchBulan = $bulan ? $tanggal->month == $bulan : true;
                $matchTahun = $tahun ? $tanggal->year == $tahun : true;
                return $matchBulan && $matchTahun;
            });
            return $paket;
        });

        $nama_paket = $request->nama_paket;

        return Pdf::loadView('dashboard.laporan.paket', compact('paketUmrahs', 'bulan', 'tahun', 'nama_paket'))
            ->stream('laporan-paket-dan-jamaah.pdf');
    }

    public function cetakJadwal(Request $request)
    {
        $query = JadwalKeberangkatan::with('paket');

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_berangkat', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_berangkat', $request->tahun);
        }

        if ($request->filled('nama_paket')) {
            $query->whereHas('paket', function ($q) use ($request) {
                $q->where('nama_paket', $request->nama_paket);
            });
        }

        $jadwals = $query->get();
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nama_paket = $request->nama_paket;

        $pdf = Pdf::loadView('dashboard.laporan.jadwal', compact('jadwals', 'bulan', 'tahun', 'nama_paket'));
        return $pdf->stream('laporan-jadwal-keberangkatan.pdf');
    }

    public function cetakDistribusi(Request $request)
    {
        $query = DistribusiPerlengkapan::with(['jamaah.user', 'perlengkapan']);
    
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_distribusi', $request->bulan);
        }
    
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_distribusi', $request->tahun);
        }
    
        $distribusi = $query->get();
    
        $bulan = $request->bulan;
        $tahun = $request->tahun;
    
        $pdf = Pdf::loadView('dashboard.laporan.distribusi', compact('distribusi', 'bulan', 'tahun'));
        return $pdf->stream('laporan-distribusi-perlengkapan.pdf');
    }
}
