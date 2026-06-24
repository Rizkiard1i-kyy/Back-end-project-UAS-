<?php

namespace App\Http\Controllers\Akademik;

use App\Models\Ksm;
use App\Models\KsmMataKuliah;
use App\Models\MataKuliah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KsmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $akses = Ksm::with('mataKuliahs');
        if ($user->isMahasiswa()) {
            $akses->where('nim', $user->nim);
        } elseif ($user->isAdmin()) {
        } else {
            abort(403, 'Anda tidak boleh mengakses halaman ini.');
        }
        $ksms = Ksm::with('mataKuliahs.mataKuliah')->get();

        return view('ksm.index', compact('ksms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mataKuliahs = MataKuliah::orderBy('kodeMatkul')->get();

        return view('ksm.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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
                'sks'        => $mk['sks'],
                'kelas'      => $mk['kelas'],
                'status'     => $mk['status'],
            ]);
        }

        return redirect()->route('ksm.index')->with('success', 'KSM berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ksm $ksm)
    {
        $ksm->load('mataKuliahs.mataKuliah');

        return view('ksm.show', compact('ksm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ksm $ksm)
    {
        $ksm->load('mataKuliahs.mataKuliah');
        $mataKuliahs = MataKuliah::orderBy('kodeMatkul')->get();

        return view('ksm.edit', compact('ksm', 'mataKuliahs'));
    }

    /**
     * Update the specified resource in storage.
     */
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
                'sks'        => $mk['sks'],
                'kelas'      => $mk['kelas'],
                'status'     => $mk['status'],
            ]);
    }

        return redirect()->route('ksm.index')->with('success', 'KSM berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ksm $ksm)
    {
        $ksm->delete();

        return redirect()->route('ksm.index')->with('success', 'KSM berhasil dihapus.');
    }
}
