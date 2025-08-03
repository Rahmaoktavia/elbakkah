<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (auth()->user()->role === 'Jamaah') {
            abort(403, 'Forbidden - Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        $query = Pembayaran::with(['pemesanan.jamaah', 'pemesanan.jadwalKeberangkatan.paket']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('pemesanan.jamaah', function ($q) use ($search) {
                $q->where('nama_jamaah', 'like', "%{$search}%");
            });
        }

        $pembayarans = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.pembayaran.index', compact('pembayarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($pemesananId)
    {
        $pemesanan = Pemesanan::with(['jamaah.user', 'jadwalKeberangkatan.paket'])
            ->where('id', $pemesananId)
            ->whereHas('jamaah', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->firstOrFail();

        return view('pengguna.pembayaran', compact('pemesanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pemesanan_id'   => 'required|exists:pemesanans,id',
            'tanggal_bayar'  => 'required|date',
            'jumlah_bayar'   => 'required|numeric|min:10000',
            'bukti_transfer' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $pemesanan = Pemesanan::with('jamaah')
            ->where('id', $request->pemesanan_id)
            ->whereHas('jamaah', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->firstOrFail();

        $buktiPath = null;
        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/'), $filename);
            $buktiPath = 'img/' . $filename;
        }

        Pembayaran::create([
            'pemesanan_id'      => $pemesanan->id,
            'tanggal_bayar'     => $request->tanggal_bayar,
            'jumlah_bayar'      => $request->jumlah_bayar,
            'bukti_transfer'    => $buktiPath,
            'status_verifikasi' => 'Menunggu',
            'catatan'           => null,
        ]);

        return redirect()->route('pengguna.riwayat_reservasi', $pemesanan->id)->with([
            'success' => 'Pembayaran berhasil dikirim dan sedang menunggu verifikasi.',
            'alert_type' => 'tambah'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pembayaran = Pembayaran::with(['pemesanan.jamaah', 'pemesanan.jadwalKeberangkatan.paket'])
            ->findOrFail($id);

        return view('dashboard.pembayaran.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        return view('dashboard.pembayaran.edit', compact('pembayaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }

    // public function updateStatus(Request $request, $id)
    // {
    //     $request->validate([
    //         'status_verifikasi' => 'required|in:Menunggu,Diterima,Ditolak',
    //         'catatan' => 'nullable|string|max:1000',
    //     ]);

    //     $pembayaran = Pembayaran::findOrFail($id);
    //     $pembayaran->status_verifikasi = $request->status_verifikasi;
    //     $pembayaran->catatan = $request->catatan;
    //     $pembayaran->save();

    //     return redirect()->route('dashboard.pembayaran.index')->with([
    //         'success' => 'Status verifikasi pembayaran berhasil diperbarui.',
    //         'alert_type' => 'edit'
    //     ]);
    // }

    public function updateStatus(Request $request, $id)
    {
        if (auth()->user()->role !== 'Direktur Keuangan') {
            return abort(403, 'Unauthorized');
        }
        
        $request->validate([
            'status_verifikasi' => 'required|in:Menunggu,Diterima,Ditolak',
            'catatan' => 'nullable|string',
        ]);
    
        // Ambil data pembayaran berdasarkan id
        $pembayaran = Pembayaran::findOrFail($id);
    
        // Update status verifikasi dan catatan
        $pembayaran->update([
            'status_verifikasi' => $request->status_verifikasi,
            'catatan' => $request->catatan,
        ]);
    
        // Jika status verifikasi pembayaran adalah Diterima
        if ($request->status_verifikasi === 'Diterima') {
            $pemesanan = $pembayaran->pemesanan;
    
            // Ambil harga dari paket (relasi jadwal -> paket)
            $hargaPaket = $pemesanan->jadwalKeberangkatan->paket->harga;
    
            // Hitung total pembayaran yang sudah Diterima
            $totalDibayar = $pemesanan->pembayarans()
                ->where('status_verifikasi', 'Diterima')
                ->sum('jumlah_bayar');
    
            // Jika total pembayaran >= harga paket, set status pembayaran menjadi Lunas
            if ($totalDibayar >= $hargaPaket) {
                $pemesanan->status_pembayaran = 'Lunas';
                $pemesanan->save();
            }
        }
    
        return redirect()->route('dashboard.pembayaran.index')->with([
            'success' => 'Status verifikasi pembayaran berhasil diperbarui.',
            'alert_type' => 'edit'
        ]);
    }


    public function cetakPDF()
    {
        $pembayarans = Pembayaran::with([
            'pemesanan.jamaah',
            'pemesanan.jadwalKeberangkatan.paket'
        ])->get();

        $pdf = Pdf::loadView('dashboard.pembayaran.cetak_pdf', compact('pembayarans'));
        return $pdf->stream('laporan-pembayaran.pdf');
    }

    public function cetakInvoice($id)
    {
        $pembayaran = Pembayaran::with('pemesanan.jamaah')->findOrFail($id);

        $pdf = Pdf::loadView('pengguna.invoice_pdf', compact('pembayaran'));
        return $pdf->stream('invoice-pembayaran.pdf');
    }

    public function riwayat()
    {
        $pemesanan = Pemesanan::with(['jamaah', 'jadwalKeberangkatan.paket', 'pembayarans'])
            ->whereHas('jamaah', fn($q) => $q->where('user_id', auth()->id()))
            ->latest()
            ->first(); // Ambil hanya satu pemesanan

        return view('pengguna.riwayat_reservasi', compact('pemesanan'));
    }

    public function getMonthlyChartData()
    {
        $monthlyPayments = Pembayaran::select(
                DB::raw("MONTH(tanggal_bayar) as month"),
                DB::raw("SUM(jumlah_bayar) as total")
            )
            ->whereYear('tanggal_bayar', now()->year)
            ->where('status_verifikasi', 'Diterima') // opsional filter
            ->groupBy(DB::raw("MONTH(tanggal_bayar)"))
            ->orderBy(DB::raw("MONTH(tanggal_bayar)"))
            ->get();

        $labels = [];
        $totals = [];

        // Biar urut dan lengkap dari Jan - Dec
        for ($i = 1; $i <= 12; $i++) {
            $labels[] = \Carbon\Carbon::create()->month($i)->format('M');
            $bulanIni = $monthlyPayments->firstWhere('month', $i);
            $totals[] = $bulanIni ? (int) $bulanIni->total : 0;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $totals
        ]);
    }
}
