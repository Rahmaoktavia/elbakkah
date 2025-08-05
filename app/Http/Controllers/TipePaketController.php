<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipePaket;

class TipePaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TipePaket::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nama_tipe', 'like', "%{$search}%");
        }

        $tipePakets = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.tipe_paket.index', compact('tipePakets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.tipe_paket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tipe' => 'required|string|max:255|unique:tipe_pakets,nama_tipe',
        ]);

        TipePaket::create($validated);

        return redirect()->route('dashboard.tipe-paket.index')->with([
            'success' => 'Tipe Paket berhasil ditambahkan',
            'alert_type' => 'tambah'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tipePaket = TipePaket::findOrFail($id);
        return view('dashboard.tipe_paket.edit', compact('tipePaket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tipePaket = TipePaket::findOrFail($id);

        $validated = $request->validate([
            'nama_tipe' => 'required|string|max:255|unique:tipe_pakets,nama_tipe,' . $tipePaket->id,
        ]);

        $tipePaket->update($validated);

        return redirect()->route('dashboard.tipe-paket.index')->with([
            'success' => 'Tipe Paket berhasil diperbarui',
            'alert_type' => 'edit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tipePaket = TipePaket::findOrFail($id);
        $tipePaket->delete();

        return redirect()->route('dashboard.tipe-paket.index')->with([
            'success' => 'Tipe Paket berhasil dihapus',
            'alert_type' => 'hapus'
        ]);
    }
}
