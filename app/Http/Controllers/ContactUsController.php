<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;
use Barryvdh\DomPDF\Facade\Pdf;

class ContactUsController extends Controller
{
    /**
     * Tampilkan form contact + daftar FAQ (untuk pengguna)
     */
    public function contactUs()
    {
        $faqs = ContactUs::where('is_published', true)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('pengguna.contact_us', compact('faqs'));
    }

    /**
     * Simpan pertanyaan dari user atau tamu
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
            'pertanyaan' => 'required|string|max:1000',
        ]);

        ContactUs::create($request->only('nama', 'email', 'pertanyaan'));

        return back()->with([
            'success' => 'Pertanyaan berhasil dikirim!',
            'alert_type' => 'tambah'
        ]);
    }

    /**
     * Halaman dashboard admin: semua pertanyaan
     */
    public function index(Request $request)
    {
        $query = ContactUs::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('pertanyaan', 'like', "%{$search}%");
        }

        $questions = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.contact_us.index', compact('questions'));
    }

    public function show(string $id)
    {
        $question = ContactUs::findOrFail($id);
        return view('dashboard.contact_us.show', compact('question'));
    }

    /**
     * Tampilkan form edit jawaban & status tampil ke publik
     */
    public function edit(string $id)
    {
        $question = ContactUs::findOrFail($id);
        return view('dashboard.contact_us.edit', compact('question'));
    }

    /**
     * Update jawaban dan status publikasi
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jawaban' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);

        $question = ContactUs::findOrFail($id);
        $question->jawaban = $request->jawaban;
        $question->is_published = $request->has('is_published');
        $question->save();

        return redirect()->route('dashboard.contact_us.index')->with([
            'success' => 'Pertanyaan berhasil diperbarui.',
            'alert_type' => 'edit'
        ]);
    }

    /**
     * Cetak PDF daftar semua pertanyaan
     */
    public function cetakPDF()
    {
        $questions = ContactUs::orderBy('created_at', 'desc')->get();
        $pdf = Pdf::loadView('dashboard.contact_us.cetak_pdf', compact('questions'));
        return $pdf->stream('laporan-contact-us.pdf');
    }
}
