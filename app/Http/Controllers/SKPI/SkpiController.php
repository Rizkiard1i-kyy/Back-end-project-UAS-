<?php

namespace App\Http\Controllers\SKPI;

use App\Models\Skpi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SkpiController extends Controller
{
    public function index()
    {
        if (auth()->user() && !in_array(auth()->user()->role, ['mahasiswa'])) {
            $skpis = Skpi::all();
        } else {
            $skpis = Skpi::where('user_id', auth()->user()->id)->get();
        }
        $totalPoint = $skpis->where('validasi', 'Valid')->sum('point');
        return view('skpi.index', compact('skpis', 'totalPoint'));
    }

    public function create()
    {
        if (auth()->user() && !in_array(auth()->user()->role, ['mahasiswa'])) {
            return redirect()->route('skpi.index')->with('error', 'Hanya mahasiswa yang bisa buat daftar skpi baru');
        }
        $kegiatans = Skpi::select('kegiatan')->whereNotNull('kegiatan')->distinct()->pluck('kegiatan');
        $jenises = Skpi::select('jenis')->whereNotNull('jenis')->distinct()->pluck('jenis');
        return view('skpi.create', compact('kegiatans', 'jenises'));
    }

    public function store(Request $request)
    {
        if (auth()->user() && !in_array(auth()->user()->role, ['mahasiswa'])) {
            return redirect()->route('skpi.index')->with('error', 'Hanya mahasiswa yang bisa buat daftar skpi baru');
        }
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
        if (auth()->user() && !in_array(auth()->user()->role, ['mahasiswa'])) {
            return redirect()->route('skpi.index')->with('error', 'Hanya mahasiswa yang bisa mengedit skpi');
        }
        $kegiatans = Skpi::select('kegiatan')->whereNotNull('kegiatan')->distinct()->pluck('kegiatan');
        $jenises = Skpi::select('jenis')->whereNotNull('jenis')->distinct()->pluck('jenis');

        return view('skpi.edit', compact('skpi', 'kegiatans', 'jenises'));
    }

    public function update(Request $request, Skpi $skpi)
    {
        $user = auth()->user();
        if (!$user->isMahasiswa()) {
            
            $request->validate([
                'validasi' => 'required',
                'point' => 'required|numeric'
            ]);

            $skpi->update([
                'validasi' => $request->validasi,
                'point' => $request->point,
            ]);

            return redirect()->route('skpi.index')->with('success', 'Data SKPI berhasil divalidasi dan poin terupdate.');
        }

        if ($user->isMahasiswa()) {
            
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
            'validasi' => 'Belum',
            'point' => $poinOtomatis
        ]);

        return redirect()->route('skpi.index')->with('success', 'Data SKPI berhasil diperbarui.');
        }
            return redirect()->route('skpi.index')->with('error', 'Akses ditolak.');
        }


    public function destroy(Skpi $skpi)
    {
        if (!auth()->user()) {
            return redirect()->route('login');
        }
        $skpi->delete();
        return redirect()->route('skpi.index')->with('success', 'Data SKPI berhasil dihapus.');
    }
}
