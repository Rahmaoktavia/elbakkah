<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Galeri::query();

        // Cek jika ada parameter 'search' di URL
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('judul_foto', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        $galeris = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.galeri.index', compact('galeris'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_foto' => 'required|string|max:255',
            'file_foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'tanggal_upload' => 'required|date',
            'deskripsi' => 'nullable|string',
        ]);

        // Handling file upload jika ada gambar galeri
        if ($request->hasFile('file_foto')) {
            $file = $request->file('file_foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $validated['file_foto'] = $filename;
        }

        // Simpan galeri ke database
        Galeri::create($validated);

        return redirect()->route('dashboard.galeri.index')->with([
        'success' => 'Galeri berhasil disimpan',
        'alert_type' => 'tambah'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('dashboard.galeri.show', compact('galeri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('dashboard.galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validated = $request->validate([
            'judul_foto' => 'required|string|max:255',
            'tanggal_upload' => 'required|date',
            'deskripsi' => 'nullable|string',
            'file_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $galeri = Galeri::findOrFail($id);

        // Jika ada file baru yang diupload
        if ($request->hasFile('file_foto')) {
            $file = $request->file('file_foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename); // Simpan di public/img
            $validated['file_foto'] = $filename;

            // Hapus file lama jika ada
            if ($galeri->file_foto) {
                $oldFilePath = public_path('img/' . $galeri->file_foto);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        }

        // Update data galeri
        $galeri->update($validated);

        return redirect()->route('dashboard.galeri.index')->with([
        'success' => 'Galeri berhasil diperbarui',
        'alert_type' => 'edit'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mengambil galeri berdasarkan ID
        $galeri = Galeri::findOrFail($id);

        // Hapus gambar terkait jika ada
        if ($galeri->file_foto) {
            $filePath = public_path('img/' . $galeri->file_foto);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Hapus galeri dari database
        Galeri::destroy($id);

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard.galeri.index')->with([
        'success' => 'Galeri berhasil dihapus',
        'alert_type' => 'hapus'
        ]);
    }

    public function cetakPDF()
    {
        $galeris = Galeri::all();

        $pdf = Pdf::loadView('dashboard.galeri.cetak_pdf', compact('galeris'));
        return $pdf->stream('laporan-galeri.pdf'); // atau ->download('laporan-galeri.pdf');
    }

    public function tampilPenggunaGaleri(Request $request)
    {
        $query = Galeri::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('judul_foto', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        $galeris = $query->orderBy('created_at', 'desc')->paginate(9);

        return view('pengguna.galeri', compact('galeris'));
    }

}
