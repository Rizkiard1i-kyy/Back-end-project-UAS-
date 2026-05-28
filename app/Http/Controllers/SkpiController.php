<?php

namespace App\Http\Controllers;

use App\Models\Skpi;
use Illuminate\Http\Request;

class SkpiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skpis = Skpi::all();
        $totalPoint = $skpis->where('validasi', 'Valid')->sum('point');
        return view('skpi.index', compact('skpis', 'totalPoint'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('skpi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $poinOtomatis = 0;
        if ($request->klasifikasi == 'Peserta') {
            $poinOtomatis = 20;
        } elseif ($request->klasifikasi == 'Panitia') {
            $poinOtomatis = 35;
        } elseif ($request->klasifikasi == 'Ketua Umum') {
            $poinOtomatis = 50;
        }
        Skpi::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id() ?? 1, 
            'kegiatan' => $request->kegiatan,
            'jenis' => $request->jenis,
            'klasifikasi' => $request->klasifikasi,
            'tgl_input' => now(),
            'bukti' => $request->bukti,
            'validasi' => 'Belum',
            'point' => $poinOtomatis
        ]);
        return redirect()->route('skpi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skpi $skpi)
    {
        return view('skpi.show', compact('skpi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skpi $skpi)
    {
        return view('skpi.edit', compact('skpi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skpi $skpi)
    {
        // 1. Validasi
        $request->validate([
            'kegiatan' => 'required',
            'jenis' => 'required',
            'klasifikasi' => 'required',
            'bukti' => 'required|url',
        ]);

        // 2. Hitung Ulang Poin Otomatis kalau klasifikasinya diubah
        $poinOtomatis = 0;
        if ($request->klasifikasi == 'Peserta') {
            $poinOtomatis = 20;
        } elseif ($request->klasifikasi == 'Panitia') {
            $poinOtomatis = 35;
        } elseif ($request->klasifikasi == 'Ketua Umum') {
            $poinOtomatis = 50;
        }

        // 3. Update data
        $skpi->update([
            'kegiatan' => $request->kegiatan,
            'jenis' => $request->jenis,
            'klasifikasi' => $request->klasifikasi,
            'bukti' => $request->bukti,
            'point' => $poinOtomatis
        ]);

        return redirect()->route('skpi.index')->with('success', 'Data SKPI berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skpi $skpi)
    {
        $skpi->delete();
        return redirect()->route('skpi.index')->with('success', 'Data SKPI berhasil dihapus.');
    }
}
