<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\JadwalKeberangkatan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pemesanan::with(['jamaah', 'jadwalKeberangkatan.paket']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('jamaah', function ($q) use ($search) {
                $q->where('nama_jamaah', 'like', "%{$search}%");
            });
        }

        $pemesanans = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.pemesanan.index', compact('pemesanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'keberangkatan_id' => 'required|exists:jadwal_keberangkatans,id',
        ]);

        $user = Auth::user();
        $jamaah = $user->jamaah;

        if (!$jamaah) {
            return redirect()->back()->with([
                'error' => 'Anda belum mengisi data jamaah!',
                'alert_type' => 'error'
            ]);
        }

        $keberangkatan = JadwalKeberangkatan::with('paket')->findOrFail($request->keberangkatan_id);

        // Cek apakah jamaah sudah pernah memesan jadwal ini
        if (Pemesanan::where('jamaah_id', $jamaah->id)
            ->where('keberangkatan_id', $keberangkatan->id)
            ->exists()) {
            return redirect()->back()->with([
                'error' => 'Anda sudah memesan jadwal ini.',
                'alert_type' => 'error'
            ]);
        }

        // Cek kuota keberangkatan
        if ($keberangkatan->kuota <= 0) {
            return redirect()->back()->with([
                'error' => 'Kuota keberangkatan sudah habis!',
                'alert_type' => 'error'
            ]);
        }

        // Buat pemesanan
        $pemesanan = Pemesanan::create([
            'jamaah_id'         => $jamaah->id,
            'keberangkatan_id'  => $keberangkatan->id,
            'tanggal_pesan'     => now(),
            'total_tagihan'     => $keberangkatan->paket->harga,
            'status_pembayaran' => 'Belum Lunas',
        ]);

        // Kurangi kuota
        $keberangkatan->kuota -= 1;
        $keberangkatan->save();

        return redirect()->route('pengguna.riwayat_reservasi', $pemesanan->id)->with([
            'success' => 'Pemesanan berhasil dilakukan.',
            'alert_type' => 'tambah'
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pemesanan = Pemesanan::with(['jamaah.user', 'jadwalKeberangkatan.paket'])->findOrFail($id);
        return view('dashboard.pemesanan.show', compact('pemesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('dashboard.pemesanan.index')->with([
            'success' => 'Data pemesanan berhasil dihapus.',
            'alert_type' => 'hapus'
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->status_pembayaran = 'Lunas';
        $pemesanan->save();

        return redirect()->back()->with([
            'success' => 'Status pembayaran diperbarui menjadi Lunas.',
            'alert_type' => 'edit'
        ]);
    }

    public function cetakPDF()
    {
        $pemesanans = Pemesanan::with(['jamaah', 'jadwalKeberangkatan.paket'])->get();

        $pdf = Pdf::loadView('dashboard.pemesanan.cetak_pdf', compact('pemesanans'));
        return $pdf->stream('laporan-pemesanan.pdf');
    }


}
