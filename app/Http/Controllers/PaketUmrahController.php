<?php

namespace App\Http\Controllers;

use App\Models\PaketUmrah;
use App\Models\TipePaket;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PaketUmrahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PaketUmrah::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nama_paket', 'like', "%{$search}%")
                  ->orWhere('fasilitas', 'like', "%{$search}%");
        }

        $paketUmrahs = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.paket.index', compact('paketUmrahs'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipePakets = TipePaket::all();
        return view('dashboard.paket.create', compact('tipePakets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket'    => 'required|string|max:255',
            'gambar_paket'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'harga'         => 'required|numeric',
            'jumlah_hari'   => 'required|integer',
            'hotel_makkah'  => 'required|string|max:255',
            'hotel_madinah' => 'required|string|max:255',
            'fasilitas'     => 'required|string',
            'deskripsi'     => 'required|string',
            'tipe_paket_id' => 'nullable|exists:tipe_pakets,id',
        ]);

        if ($request->hasFile('gambar_paket')) {
            $file = $request->file('gambar_paket');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $validated['gambar_paket'] = $filename;
        }

        PaketUmrah::create($validated);

        return redirect()->route('dashboard.paket.index')->with([
            'success' => 'Paket Umrah berhasil disimpan',
            'alert_type' => 'tambah'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paket = PaketUmrah::with('tipePaket')->findOrFail($id);
        return view('dashboard.paket.show', compact('paket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paket = PaketUmrah::findOrFail($id);
        $tipePakets = TipePaket::all();
        return view('dashboard.paket.edit', compact('paket', 'tipePakets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_paket'    => 'required|string|max:255',
            'gambar_paket'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'harga'         => 'required|numeric',
            'jumlah_hari'   => 'required|integer',
            'hotel_makkah'  => 'required|string|max:255',
            'hotel_madinah' => 'required|string|max:255',
            'fasilitas'     => 'required|string',
            'deskripsi'     => 'required|string',
            'tipe_paket_id' => 'nullable|exists:tipe_pakets,id',
        ]);

        $paket = PaketUmrah::findOrFail($id);

        if ($request->hasFile('gambar_paket')) {
            $file = $request->file('gambar_paket');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $validated['gambar_paket'] = $filename;

            // Hapus gambar lama jika ada
            if ($paket->gambar_paket) {
                $oldFile = public_path('img/' . $paket->gambar_paket);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
        }

        $paket->update($validated);

        return redirect()->route('dashboard.paket.index')->with([
            'success' => 'Paket Umrah berhasil diperbarui',
            'alert_type' => 'edit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paket = PaketUmrah::findOrFail($id);

        if ($paket->gambar_paket) {
            $filePath = public_path('img/' . $paket->gambar_paket);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        PaketUmrah::destroy($id);

        return redirect()->route('dashboard.paket.index')->with([
            'success' => 'Paket Umrah berhasil dihapus',
            'alert_type' => 'hapus'
        ]);
    }
    /**
     * Export data to PDF.
     */
    public function cetakPDF()
    {
        $paketUmrahs = PaketUmrah::all();

        $pdf = Pdf::loadView('dashboard.paket.cetak_pdf', compact('paketUmrahs'));
        return $pdf->stream('laporan-paket-umrah.pdf');
    }

    public function listPaket(Request $request)
    {
        // Cek apakah user login
        if (auth()->check()) {
            $user = auth()->user();

            // Cek jika role termasuk yang dilarang
            if (in_array($user->role, ['Direktur Keuangan', 'Admin', 'Pimpinan'])) {
                abort(403, 'Forbidden - Anda tidak memiliki akses ke halaman ini.');
            }
        }

        $query = PaketUmrah::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nama_paket', 'like', "%{$search}%")
                ->orWhere('fasilitas', 'like', "%{$search}%");
        }

        if ($request->filled('hari')) {
            $query->where('jumlah_hari', $request->hari);
        }

        if ($request->filled('harga')) {
            $query->where('harga', '<=', $request->harga);
        }

        if ($request->filled('tipe')) {
            $query->where('tipe_paket_id', $request->tipe);
        }

        $paketUmrahs = $query->orderBy('created_at', 'desc')->paginate(6)->withQueryString();

        $tipePaketList = TipePaket::all();

        return view('pengguna.paket', compact('paketUmrahs', 'tipePaketList'));
    }

    public function showPaket($id)
    {
        // Cek apakah user login
        if (auth()->check()) {
            $user = auth()->user();

            // Jika role user termasuk yang dilarang
            if (in_array($user->role, ['Direktur Keuangan', 'Admin', 'Pimpinan'])) {
                abort(403, 'Forbidden - Anda tidak memiliki akses untuk melihat paket ini.');
            }
        }

        // Tamu (belum login) dan Jamaah bisa lanjut

        $paketUmrahs = PaketUmrah::with('jadwalKeberangkatan')->findOrFail($id);
        $jadwals = $paketUmrahs->jadwalKeberangkatan;

        $otherPaketUmrahs = PaketUmrah::where('id', '!=', $paketUmrahs->id)
            ->latest()
            ->take(3)
            ->get();

        return view('pengguna.detail_paket', compact('paketUmrahs', 'jadwals', 'otherPaketUmrahs'));
    }
}
