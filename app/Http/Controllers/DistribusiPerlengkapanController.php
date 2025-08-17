<?php

namespace App\Http\Controllers;

use App\Models\DistribusiPerlengkapan;
use App\Models\InventarisPerlengkapan;
use App\Models\Jamaah;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DistribusiPerlengkapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DistribusiPerlengkapan::with(['jamaah', 'perlengkapan']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('jamaah', function ($q) use ($search) {
                $q->where('nama_jamaah', 'like', "%{$search}%");
            })->orWhereHas('perlengkapan', function ($q) use ($search) {
                $q->where('nama_perlengkapan', 'like', "%{$search}%");
            });
        }

        $distribusi = $query->orderBy('tanggal_distribusi', 'desc')->paginate(10);
        return view('dashboard.distribusi.index', compact('distribusi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jamaahs = Jamaah::with('user')->get();
        $perlengkapans = InventarisPerlengkapan::all();
        return view('dashboard.distribusi.create', compact('jamaahs', 'perlengkapans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jamaah_id'          => 'required|exists:jamaahs,id',
            'perlengkapan_id'    => 'required|exists:inventaris_perlengkapans,id',
            'jumlah_diberikan'   => 'required|integer|min:1',
            'tanggal_distribusi' => 'required|date',
        ]);

        // Ambil data perlengkapan
        $perlengkapan = InventarisPerlengkapan::findOrFail($validated['perlengkapan_id']);

        // Cek apakah stok cukup
        if ($validated['jumlah_diberikan'] > $perlengkapan->jumlah_tersedia) {
            return back()->withErrors(['jumlah_diberikan' => 'Stok tidak mencukupi'])->withInput();
        }

        // Kurangi stok
        $perlengkapan->jumlah_tersedia -= $validated['jumlah_diberikan'];
        $perlengkapan->save();

        // Simpan distribusi
        DistribusiPerlengkapan::create($validated);

        return redirect()->route('dashboard.distribusi.index')->with([
            'success' => 'Distribusi perlengkapan berhasil disimpan',
            'alert_type' => 'tambah'
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $distribusi = DistribusiPerlengkapan::with(['jamaah.user', 'perlengkapan'])->findOrFail($id);
        return view('dashboard.distribusi.show', compact('distribusi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $distribusi = DistribusiPerlengkapan::findOrFail($id);
        $jamaahs = Jamaah::with('user')->get();
        $perlengkapans = InventarisPerlengkapan::all();
        return view('dashboard.distribusi.edit', compact('distribusi', 'jamaahs', 'perlengkapans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jamaah_id'          => 'required|exists:jamaahs,id',
            'perlengkapan_id'    => 'required|exists:inventaris_perlengkapans,id',
            'jumlah_diberikan'   => 'required|integer|min:1',
            'tanggal_distribusi' => 'required|date',
        ]);

        $distribusi = DistribusiPerlengkapan::findOrFail($id);
        $perlengkapan = InventarisPerlengkapan::findOrFail($validated['perlengkapan_id']);

        // Jika perlengkapan tidak berubah
        if ($distribusi->perlengkapan_id == $validated['perlengkapan_id']) {
            $selisih = $validated['jumlah_diberikan'] - $distribusi->jumlah_diberikan;

            if ($selisih > 0 && $selisih > $perlengkapan->jumlah_tersedia) {
                return back()->withErrors(['jumlah_diberikan' => 'Stok tidak mencukupi'])->withInput();
            }

            // Update stok
            $perlengkapan->jumlah_tersedia -= $selisih;
            $perlengkapan->save();
        } else {
            // Jika perlengkapan berubah, kembalikan stok lama & kurangi stok baru
            $oldPerlengkapan = InventarisPerlengkapan::findOrFail($distribusi->perlengkapan_id);
            $oldPerlengkapan->jumlah_tersedia += $distribusi->jumlah_diberikan;
            $oldPerlengkapan->save();

            if ($validated['jumlah_diberikan'] > $perlengkapan->jumlah_tersedia) {
                return back()->withErrors(['jumlah_diberikan' => 'Stok tidak mencukupi'])->withInput();
            }

            $perlengkapan->jumlah_tersedia -= $validated['jumlah_diberikan'];
            $perlengkapan->save();
        }

        // Update distribusi
        $distribusi->update($validated);

        return redirect()->route('dashboard.distribusi.index')->with([
            'success' => 'Distribusi berhasil diperbarui',
            'alert_type' => 'edit'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DistribusiPerlengkapan::destroy($id);

        return redirect()->route('dashboard.distribusi.index')->with([
            'success' => 'Distribusi perlengkapan berhasil dihapus',
            'alert_type' => 'hapus'
        ]);
    }

    public function cetakPDF()
    {
        $distribusi = DistribusiPerlengkapan::with(['jamaah.user', 'perlengkapan'])->get();
        
        $pdf = Pdf::loadView('dashboard.distribusi.cetak_pdf', compact('distribusi'));
        return $pdf->stream('laporan-distribusi-perlengkapan.pdf');
    }

    public function riwayatPerlengkapan()
    {
        $jamaah = auth()->user()->jamaah;

        $distribusi = DistribusiPerlengkapan::with('perlengkapan')
            ->where('jamaah_id', $jamaah->id)
            ->orderBy('tanggal_distribusi', 'desc')
            ->get();

        return view('pengguna.riwayat_perlengkapan', compact('distribusi'));
    }

}
