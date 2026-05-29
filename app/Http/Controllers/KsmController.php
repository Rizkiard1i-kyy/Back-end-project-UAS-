<?php

namespace App\Http\Controllers;

use App\Models\Ksm;
use App\Models\KsmMataKuliah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KsmController extends Controller
{
    public function index()
    {
        $ksms = Ksm::with('mataKuliahs')->get();

        return view('ksm.index', compact('ksms'));
    }

    public function create()
    {
        return view('ksm.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'nim'           => 'required|string|max:20',
            'prodi'         => 'required|string|max:255',
            'semester'      => 'required|string|in:Genap,Ganjil',
            'tahunAkademik' => 'required|string|max:20',

            'mataKuliahs'               => 'required|array|min:1',
            'mataKuliahs.*.kodeMatkul'  => 'required|string|max:10',
            'mataKuliahs.*.namaMatkul'  => 'required|string|max:255',
            'mataKuliahs.*.sks'         => 'required|integer|min:1',
            'mataKuliahs.*.kelas'       => 'required|string|max:5',
            'mataKuliahs.*.status'      => 'required|string|max:5',
        ]);

        $ksm = Ksm::create($request->only(
            'nama', 'nim', 'prodi', 'semester', 'tahunAkademik'
        ));

        foreach ($request->mataKuliahs as $index => $mk) {
            KsmMataKuliah::create([
                'ksm_id'     => $ksm->id,
                'no'         => $index + 1,
                'kodeMatkul' => $mk['kodeMatkul'],
                'namaMatkul' => $mk['namaMatkul'],
                'sks'        => $mk['sks'],
                'kelas'      => $mk['kelas'],
                'status'     => $mk['status'],
            ]);
        }

        return redirect()->route('ksm.show', $ksm)
            ->with('success', 'KSM berhasil dibuat.');
    }

    public function show(Ksm $ksm)
    {
        $ksm->load('mataKuliahs');

        return view('ksm.show', compact('ksm'));
    }

    public function edit(Ksm $ksm)
    {
        $ksm->load('mataKuliahs');

        return view('ksm.edit', compact('ksm'));
    }

    public function update(Request $request, Ksm $ksm)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'nim'           => 'required|string|max:20',
            'prodi'         => 'required|string|max:255',
            'semester'      => 'required|string|in:Genap,Ganjil',
            'tahunAkademik' => 'required|string|max:20',

            'mataKuliahs'               => 'required|array|min:1',
            'mataKuliahs.*.kodeMatkul'  => 'required|string|max:10',
            'mataKuliahs.*.namaMatkul'  => 'required|string|max:255',
            'mataKuliahs.*.sks'         => 'required|integer|min:1',
            'mataKuliahs.*.kelas'       => 'required|string|max:5',
            'mataKuliahs.*.status'      => 'required|string|max:5',
        ]);

        $ksm->update($request->only(
            'nama', 'nim', 'prodi', 'semester', 'tahunAkademik'
        ));

        $ksm->mataKuliahs()->delete();

        foreach ($request->mataKuliahs as $index => $mk) {
            KsmMataKuliah::create([
                'ksm_id'     => $ksm->id,
                'no'         => $index + 1,
                'kodeMatkul' => $mk['kodeMatkul'],
                'namaMatkul' => $mk['namaMatkul'],
                'sks'        => $mk['sks'],
                'kelas'      => $mk['kelas'],
                'status'     => $mk['status'],
            ]);
        }

        return redirect()->route('ksm.show', $ksm)
            ->with('success', 'KSM berhasil diperbarui.');
    }

    public function destroy(Ksm $ksm)
    {
        $ksm->delete();

        return redirect()->route('ksm.index')
            ->with('success', 'KSM berhasil dihapus.');
    }
}
