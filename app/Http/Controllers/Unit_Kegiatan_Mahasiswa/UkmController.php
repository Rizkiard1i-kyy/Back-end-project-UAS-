<?php

namespace App\Http\Controllers\Unit_Kegiatan_Mahasiswa;

use App\Models\ukm;
use App\Models\Pengguna;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UkmController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $akses = ukm::with(['mahasiswa']);

        if ($user->isMahasiswa()) {
            $akses->where('nim', $user->id);
        }

        $ukm = $akses->get();
        return view('ukms.index', compact('ukm'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh membuat UKM baru.');
        }

        $mahasiswas = Pengguna::where('role', 'mahasiswa')->get();

        return view('ukms.create', compact('mahasiswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required|string|min:1',
            'nim'=>'required|exists:users,id',
            'anggota'=>'required|integer|min:1',
            'detail'=>'required|string|min:1',
        ]);

        ukm::create($request->only(
            'nama',
            'nim',
            'anggota',
            'detail',
        ));
        return redirect()->route('ukm.index')->with('success', 'UKM baru dibuat.');
    }

    public function show(ukm $ukm)
    {
        $user = auth()->user();

        return view('ukms.show', compact('ukm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ukm $ukm)
    {
        $user = auth()->user();

        if (!$user->isAdmin()) {
            abort(403, 'Anda tidak boleh mengubah UKM.');
        }

        $mahasiswas = Pengguna::where('role', 'mahasiswa')->get();

        return view('ukms.edit', compact('ukm','mahasiswas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ukm $ukm)
    {
        $user = auth()->user();

        if (!$user->isAdmin()) {
            abort(403, 'Anda tidak boleh mengubah UKM.');
        } else{}

        if ($user->isAdmin()) {
            $request->validate([
                'nama'=>'required|string|min:1',
                'nim'=>'required|exists:users,id',
                'anggota'=>'required|integer|min:1',
                'detail'=>'required|string|min:1',
            ]);
        }

        $ukm->update($request->only(
            'nama',
            'nim',
            'anggota',
            'detail',
        ));
        return redirect()->route('ukm.index')->with('success', 'UKM diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ukm $ukm)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh menghapus UKM.');
        }
        $ukm->delete();
        return redirect()->route('ukm.index')->with('success', 'UKM dihapus.');
    }
}
