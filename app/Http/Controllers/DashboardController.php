<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketUmrah;
use App\Models\Jamaah;
use App\Models\Pemesanan;
use App\Models\DistribusiPerlengkapan;

class DashboardController extends Controller
{
  
    public function dashboard()
    {
        $totalPaket = PaketUmrah::count();
        $totalJamaah = Jamaah::count();
        $totalPemesanan = Pemesanan::count();
        $totalDistribusi = DistribusiPerlengkapan::count();

        $topPaket = PaketUmrah::withCount('pemesanan')
                ->orderByDesc('pemesanan_count')
                ->take(3)
                ->get();

        return view('dashboard.index', compact(
            'totalPaket',
            'totalJamaah',
            'totalPemesanan',
            'totalDistribusi',
            'topPaket'
        ));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalPaket = PaketUmrah::count();
        $totalJamaah = Jamaah::count();
        $totalPemesanan = Pemesanan::count();
        $totalDistribusi = DistribusiPerlengkapan::count();

        $topPaket = PaketUmrah::withCount('pemesanan')
                    ->orderByDesc('pemesanan_count')
                    ->take(3)
                    ->get();

        return view('dashboard.index', compact(
            'totalPaket', 'totalJamaah', 'totalPemesanan', 'totalDistribusi', 'topPaket'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
