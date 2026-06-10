<?php

namespace App\Http\Controllers;

use App\Models\Skpi;
use Illuminate\Http\Request;

class SkpiController extends Controller
{
    public function index()
    {
        $skpis = Skpi::all();
        $totalPoint = $skpis->where('validasi', 'Valid')->sum('point');
        return view('skpi.index', compact('skpis', 'totalPoint'));
    }

    public function create()
    {
        if (!in_array(auth()->user()->role, ['mahasiswa'])) {
            return redirect()->route('skpi.index')->with('error', 'Hanya mahasiswa yang bisa buat daftar skpi baru');
        }
        return view('skpi.create');
    }

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

    public function show(Skpi $skpi)
    {
        return view('skpi.show', compact('skpi'));
    }

    public function edit(Skpi $skpi)
    {
        if (!in_array(auth()->user()->role, ['mahasiswa'])) {
            return redirect()->route('skpi.index')->with('error', 'Hanya mahasiswa yang bisa buat daftar skpi baru');
        }
        return view('skpi.edit', compact('skpi'));
    }

    public function update(Request $request, Skpi $skpi)
    {
        $request->validate([
            'kegiatan' => 'required',
            'jenis' => 'required',
            'klasifikasi' => 'required',
            'bukti' => 'required|url',
        ]);

        $poinOtomatis = 0;
        if ($request->klasifikasi == 'Peserta') {
            $poinOtomatis = 15;
        } elseif ($request->klasifikasi == 'Panitia') {
            $poinOtomatis = 25;
        } elseif ($request->klasifikasi == 'Ketua Umum') {
            $poinOtomatis = 50;
        }
        $skpi->update([
            'kegiatan' => $request->kegiatan,
            'jenis' => $request->jenis,
            'klasifikasi' => $request->klasifikasi,
            'bukti' => $request->bukti,
            'point' => $poinOtomatis
        ]);

        return redirect()->route('skpi.index')->with('success', 'Data SKPI berhasil diperbarui.');
    }

    public function destroy(Skpi $skpi)
    {
        if (!in_array(auth()->user()->role, ['mahasiswa'])) {
            return redirect()->route('skpi.index')->with('error', 'Hanya mahasiswa yang bisa buat daftar skpi baru');
        }
        $skpi->delete();
        return redirect()->route('skpi.index')->with('success', 'Data SKPI berhasil dihapus.');
    }
}
