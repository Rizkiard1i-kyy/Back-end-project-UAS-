<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->isAdmin()) {
            $konsultasi = Konsultasi::orderBy('tanggal', 'desc')->get();
        } elseif ($user->isDosen()) {
            $konsultasi = Konsultasi::where('dosen_id', $user->id)->orderBy('tanggal', 'desc')->get();
        } else {
            $konsultasi = Konsultasi::where('nim', $user->nim)->orderBy('tanggal', 'desc')->get();
        }

        return view('Konsultasi.index', compact('konsultasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->isMahasiswa()) {
            abort(403, 'cuma mahasiswa yang bisa mengajukan konsultasi.');
        }

        $dosenList = Pengguna::where('role', 'dosen')->orderBy('nama')->get();

        return view('Konsultasi.create', compact('dosenList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->isMahasiswa()) {abort(403, 'cuma mahasiswa yang bisa mengajukan konsultasi.');
        }

        $request->validate([
            'dosen_id' => 'required|exists:users,id',
            'tanggal'=>'required|date|after_or_equal:today',
            'jam'=>'required|string|max:20',
            'topik'=>'required|string|max:1000',
        ]);

        $dosen = Pengguna::where('id', $request->dosen_id)->where('role', 'dosen')->firstOrFail();

        Konsultasi::create([
            'nim'=>auth()->user()->nim,
            'nama_mahasiswa'=>auth()->user()->nama,
            'nama_dosen' =>$dosen->nama,
            'dosen_id'=>$dosen->id,
            'tanggal'=>$request->tanggal,
            'jam'=>$request->jam,
            'topik'=>$request->topik,
            'status'=>'menunggu',
        ]);

        return redirect()->route('konsultasi.index')->with('success', 'Permintaan konsultasi berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Konsultasi $konsultasi)
    {
        $user = auth()->user();

        if ($user->isMahasiswa() && $konsultasi->nim !== $user->nim) {abort(403);
        }

        if ($user->isDosen() && $konsultasi->dosen_id !== $user->id) {abort(403);
        }

        return view('Konsultasi.show', compact('konsultasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Konsultasi $konsultasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Konsultasi $konsultasi)
    {
        $user = auth()->user();

        if ($user->isMahasiswa()) {
            abort(403, 'mahasiswa tidak bisa ngubah status konsultasi.');
        }

        if ($user->isDosen() && $konsultasi->dosen_id !== $user->id) {
            abort(403, 'anda tidak ada hak untuk memperbarui.');
        }

        if ($konsultasi->status !== 'menunggu') {return redirect()->back()->with('error', 'Konsultasi lagi diproses.');
        }

        $request->validate([
            'status'=>'required|in:disetujui,ditolak',
            'catatan'=>'nullable|string|max:1000',
        ]);

        $konsultasi->update($request->only('status', 'catatan'));

        return redirect()->route('konsultasi.index')->with('success', 'status konsultasi diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Konsultasi $konsultasi)
    {
        //
    }
}