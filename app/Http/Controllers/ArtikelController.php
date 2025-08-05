<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Artikel::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('judul_artikel', 'like', "%{$search}%")
                  ->orWhere('isi_artikel', 'like', "%{$search}%");
        }

        $artikels = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.artikel.index', compact('artikels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_artikel'   => 'required|string|max:255',
            'isi_artikel'     => 'required|string',
            'gambar_sampul'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_published'    => 'nullable|boolean', 
        ]);
        
        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('gambar_sampul')) {
            $file = $request->file('gambar_sampul');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $validated['gambar_sampul'] = $filename;
        }

        Artikel::create($validated);

        return redirect()->route('dashboard.artikel.index')->with([
        'success' => 'Artikel berhasil disimpan',
        'alert_type' => 'tambah'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('dashboard.artikel.show', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('dashboard.artikel.edit', compact('artikel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'judul_artikel'   => 'required|string|max:255',
            'isi_artikel'     => 'required|string',
            'gambar_sampul'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_published'    => 'nullable|boolean', 
        ]);
        
        $validated['is_published'] = $request->has('is_published');

        $artikel = Artikel::findOrFail($id);

        if ($request->hasFile('gambar_sampul')) {
            $file = $request->file('gambar_sampul');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $validated['gambar_sampul'] = $filename;

            // Hapus gambar lama jika ada
            if ($artikel->gambar_sampul) {
                $oldFile = public_path('img/' . $artikel->gambar_sampul);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
        }

        $artikel->update($validated);

        return redirect()->route('dashboard.artikel.index')->with([
        'success' => 'Artikel berhasil diperbarui',
        'alert_type' => 'edit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $artikel = Artikel::findOrFail($id);

        if ($artikel->gambar_sampul) {
            $filePath = public_path('img/' . $artikel->gambar_sampul);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        Artikel::destroy($id);

        return redirect()->route('dashboard.artikel.index')->with([
        'success' => 'Artikel berhasil dihapus',
        'alert_type' => 'hapus'
        ]);
    }

    public function cetakPDF()
    {
        $artikels = Artikel::all();

        $pdf = Pdf::loadView('dashboard.artikel.cetak_pdf', compact('artikels'));
        return $pdf->stream('laporan-artikel.pdf');
    }

    public function artikel()
    {
        $artikels = Artikel::where('is_published', true)
                    ->orderBy('created_at', 'desc')
                    ->paginate(6);

        return view('pengguna.artikel', compact('artikels'));
    }

    public function detailArtikel($id)
    {
        $artikel = Artikel::where('id', $id)->where('is_published', true)->firstOrFail();

        $artikelTerbaru = Artikel::where('id', '!=', $id)
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('pengguna.detail_artikel', compact('artikel', 'artikelTerbaru'));
    }
}
