<?php

namespace App\Http\Controllers;

use App\Models\Jamaah;
use App\Models\User;
use App\Models\PaketUmrah;
use App\Models\JadwalKeberangkatan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class JamaahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Jamaah::with('user');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nik', 'like', "%{$search}%")
                  ->orWhere('nama_jamaah', 'like', "%{$search}%")
                  ->orWhere('nama_ayah', 'like', "%{$search}%")
                  ->orWhere('pekerjaan', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $jamaahs = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.jamaah.index', compact('jamaahs'));
    }

    /**
     * Show the form for creating a new resource.
     */

        public function create(Request $request)
    {
        // Cek jika user login
        if (auth()->check()) {
            $user = auth()->user();

            // Jika role-nya termasuk yang dilarang
            if (in_array($user->role, ['Direktur Keuangan', 'Admin', 'Pimpinan'])) {
                abort(403, 'Forbidden - Anda tidak memiliki akses ke halaman ini.');
            }
        }

        // Lanjutkan proses form jamaah
        $users = User::all();
        $jadwalId = $request->input('jadwal_id');
        $paketId = $request->input('paket_id');

        $paketUmrahs = PaketUmrah::findOrFail($paketId);
        $jadwal = JadwalKeberangkatan::findOrFail($jadwalId);

        return view('pengguna.formjamaah', compact('users', 'jadwalId', 'paketId', 'paketUmrahs', 'jadwal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_jamaah' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pas_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'file_ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_paspor' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        foreach (['pas_foto', 'file_ktp', 'file_kk', 'file_paspor'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . "_{$field}." . $file->getClientOriginalExtension();
                $file->move(public_path('img'), $filename);
                $validated[$field] = $filename;
            }
        }

        Jamaah::create($validated);

        return redirect()->back()->with([
            'success' => 'Data jamaah berhasil disimpan.',
            'alert_type' => 'tambah'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jamaah = Jamaah::with('user')->findOrFail($id);
        return view('dashboard.jamaah.show', compact('jamaah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jamaah = Jamaah::findOrFail($id);
        $users = User::all();
        return view('dashboard.jamaah.edit', compact('jamaah', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $jamaah = Jamaah::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            // 'nama_jamaah' => 'required|string|max:255',
            // 'nik' => 'required|string|max:255',
            // 'tempat_lahir' => 'required|string|max:255',
            // 'tanggal_lahir' => 'required|date',
            // 'alamat' => 'required|string',
            // 'no_telepon' => 'required|string|max:255',
            // 'nama_ayah' => 'required|string|max:255',
            // 'pekerjaan' => 'required|string|max:255',
            // 'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pas_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'file_ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_paspor' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        foreach (['pas_foto', 'file_ktp', 'file_kk', 'file_paspor'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama
                $oldFile = public_path('img/' . $jamaah->$field);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }

                $file = $request->file($field);
                $filename = time() . "_{$field}." . $file->getClientOriginalExtension();
                $file->move(public_path('img'), $filename);
                $validated[$field] = $filename;
            }
        }

        $jamaah->update($validated);

        return redirect()->route('dashboard.jamaah.index')->with([
            'success' => 'Data jamaah berhasil diperbarui.',
            'alert_type' => 'edit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jamaah = Jamaah::findOrFail($id);

        foreach (['pas_foto', 'file_ktp', 'file_kk', 'file_paspor'] as $field) {
            $filePath = public_path('img/' . $jamaah->$field);
            if ($jamaah->$field && file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $jamaah->delete();

        return redirect()->route('dashboard.jamaah.index')->with([
            'success' => 'Data jamaah berhasil dihapus.',
            'alert_type' => 'hapus'
        ]);
    }

    public function cetakPDF()
    {
        $jamaahs = Jamaah::with('user')->get();

        $pdf = Pdf::loadView('dashboard.jamaah.cetak_pdf', compact('jamaahs'));
        return $pdf->stream('laporan-jamaah.pdf');
    }

    public function dokumenSaya()
    {
        $jamaah = Jamaah::where('user_id', auth()->id())->firstOrFail();
        return view('pengguna.dokumen_jamaah', compact('jamaah'));
    }

    public function editDokumenSaya()
    {
        $jamaah = Jamaah::where('user_id', auth()->id())->firstOrFail();
        return view('pengguna.edit_dokumen_jamaah', compact('jamaah'));
    }


    public function updateDokumenSaya(Request $request)
    {
        $jamaah = Jamaah::where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'nama_jamaah' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',

            'pas_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'file_ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_paspor' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // File upload handling
        foreach (['pas_foto', 'file_ktp', 'file_kk', 'file_paspor'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama jika ada
                if ($jamaah->$field && file_exists(public_path('img/' . $jamaah->$field))) {
                    unlink(public_path('img/' . $jamaah->$field));
                }

                $file = $request->file($field);
                $filename = time() . "_{$field}." . $file->getClientOriginalExtension();
                $file->move(public_path('img'), $filename);
                $validated[$field] = $filename;
            }
        }

        $jamaah->update($validated);

        return redirect()->route('jamaah.dokumenSaya')->with([
            'success' => 'Dokumen berhasil diperbarui.',
            'alert_type' => 'edit'
        ]);        
    }
}
