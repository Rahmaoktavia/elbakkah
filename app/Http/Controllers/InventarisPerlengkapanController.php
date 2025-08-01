<?php

namespace App\Http\Controllers;

use App\Models\InventarisPerlengkapan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InventarisPerlengkapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = InventarisPerlengkapan::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nama_perlengkapan', 'like', "%{$search}%")
                  ->orWhere('satuan', 'like', "%{$search}%");
        }

        $inventaris = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.inventaris.index', compact('inventaris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.inventaris.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_perlengkapan' => 'required|string|max:255',
            'jumlah_total'      => 'required|integer|min:0',
            'jumlah_tersedia'   => 'required|integer|min:0|lte:jumlah_total',
            'satuan'            => 'required|in:Pcs,Set,Paket',
            'tanggal_input'     => 'required|date',
        ]);

        InventarisPerlengkapan::create($validated);

        return redirect()->route('dashboard.inventaris.index')->with([
            'success' => 'Inventaris berhasil disimpan',
            'alert_type' => 'tambah'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $inventaris = InventarisPerlengkapan::findOrFail($id);
        return view('dashboard.inventaris.show', compact('inventaris'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $inventaris = InventarisPerlengkapan::findOrFail($id);
        return view('dashboard.inventaris.edit', compact('inventaris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_perlengkapan' => 'required|string|max:255',
            'jumlah_total'      => 'required|integer|min:0',
            'jumlah_tersedia'   => 'required|integer|min:0|lte:jumlah_total',
            'satuan'            => 'required|in:Pcs,Set,Paket',
            'tanggal_input'     => 'required|date',
        ]);

        $inventaris = InventarisPerlengkapan::findOrFail($id);
        $inventaris->update($validated);

        return redirect()->route('dashboard.inventaris.index')->with([
            'success' => 'Inventaris berhasil diperbarui',
            'alert_type' => 'edit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        InventarisPerlengkapan::destroy($id);

        return redirect()->route('dashboard.inventaris.index')->with([
            'success' => 'Inventaris berhasil dihapus',
            'alert_type' => 'hapus'
        ]);
    }

    public function cetakPDF()
    {
        $inventaris = InventarisPerlengkapan::all();

        $pdf = Pdf::loadView('dashboard.inventaris.cetak_pdf', compact('inventaris'));
        return $pdf->stream('laporan-inventaris-perlengkapan.pdf');
    }
}
