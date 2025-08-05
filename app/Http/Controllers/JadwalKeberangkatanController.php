<?php

namespace App\Http\Controllers;

use App\Models\JadwalKeberangkatan;
use App\Models\PaketUmrah;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class JadwalKeberangkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JadwalKeberangkatan::with('paket');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('paket', function ($q) use ($search) {
                $q->where('nama_paket', 'like', "%{$search}%");
            });
        }

        $jadwals = $query->orderBy('tanggal_berangkat', 'desc')->paginate(10);
        $paketUmrahs = PaketUmrah::all(); 

        return view('dashboard.jadwal.index', compact('jadwals', 'paketUmrahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paketUmrahs = PaketUmrah::all();
        return view('dashboard.jadwal.create', compact('paketUmrahs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'paket_id'          => 'required|exists:paket_umrahs,id',
            'tanggal_berangkat' => 'required|date',
            'kuota'             => 'nullable|integer',
        ]);

        JadwalKeberangkatan::create($validated);

        return redirect()->route('dashboard.jadwal.index')->with([
            'success' => 'Jadwal Keberangkatan berhasil disimpan',
            'alert_type' => 'tambah'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jadwal = JadwalKeberangkatan::with('paket')->findOrFail($id);
        return view('dashboard.jadwal.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jadwal = JadwalKeberangkatan::findOrFail($id);
        $paketUmrahs = PaketUmrah::all();
        return view('dashboard.jadwal.edit', compact('jadwal', 'paketUmrahs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'paket_id'          => 'required|exists:paket_umrahs,id',
            'tanggal_berangkat' => 'required|date',
            'kuota'             => 'nullable|integer',
        ]);

        $jadwal = JadwalKeberangkatan::findOrFail($id);
        $jadwal->update($validated);

        return redirect()->route('dashboard.jadwal.index')->with([
            'success' => 'Jadwal Keberangkatan berhasil diperbarui',
            'alert_type' => 'edit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        JadwalKeberangkatan::destroy($id);

        return redirect()->route('dashboard.jadwal.index')->with([
            'success' => 'Jadwal Keberangkatan berhasil dihapus',
            'alert_type' => 'hapus'
        ]);
    }

    public function cetakPDF()
    {
        $jadwals = JadwalKeberangkatan::with('paket')->get();

        $pdf = Pdf::loadView('dashboard.jadwal.cetak_pdf', compact('jadwals'));
        return $pdf->stream('laporan-jadwal-keberangkatan.pdf');
    }
}
