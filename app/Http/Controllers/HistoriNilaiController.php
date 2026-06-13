<?php

namespace App\Http\Controllers;

use App\Models\historiNilai;
use App\Models\Pengguna;
use App\Models\MataKuliah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoriNilaiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $akses = historiNilai::with(['mahasiswa','dosen','mataKuliah']);

        if ($user->isMahasiswa()) {
            $akses->where('nim', $user->id);
        } elseif ($user->isDosen()) {
            $akses->where('namaDosen', $user->id);
        }

        $historiNilai = $akses->get();
        return view('historiNilais.index', compact('historiNilai'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh membuat data histori nilai.');
        }

        $mahasiswas = Pengguna::where('role', 'mahasiswa')->get();
        $dosens = Pengguna::where('role', 'dosen')->get();
        $namaMataKuliahs = MataKuliah::all();

        return view('historiNilais.create', compact('mahasiswas', 'dosens','namaMataKuliahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim'=>'required|exists:users,id',
            'namaDosen'=>'required|exists:users,id',
            'tahunAkademik'=>'required|integer|min:19591',
            'namaMataKuliah'=>'required|exists:mata_kuliahs,id',
            'bobot'=>'required|numeric|max:4.00',
        ]);
        
        $bobot = $request->bobot;
        if ($bobot == 4.00) {
            $request['nilai'] = 'A';
        } elseif ($bobot >=  3.70) {
            $request['nilai'] = 'A-';
        } elseif ($bobot >= 3.40) {
            $request['nilai'] = 'B+';
        } elseif ($bobot >= 3.00) {
            $request['nilai'] = 'B';
        } elseif ($bobot >= 2.64) {
            $request['nilai'] = 'B-';
        } elseif ($bobot >= 2.35) {
            $request['nilai'] = 'C+';
        } elseif ($bobot >= 2.00) {
            $request['nilai'] = 'C';
        } elseif ($bobot >= 1.00) {
            $request['nilai'] = 'D';
        } else {
            $request['nilai'] = 'E';
        }

        historiNilai::create($request->only(
            'nim',
            'namaDosen',
            'tahunAkademik',
            'namaMataKuliah',
            'nilai',
            'bobot'));
        return redirect()->route('historiNilai.index')->with('success', 'Data histori nilai baru dibuat.');
    }

    public function show(historiNilai $historiNilai)
    {
        $user = auth()->user();
    
        if ($user->isMahasiswa() && $historiNilai->nim !== $user->id) {
            abort(403, 'Anda tidak bisa melihat data histori nilai mahasiswa lain.');
        }

        if ($user->isDosen() && $historiNilai->namaDosen !== $user->id) {
            abort(403, 'Anda tidak bisa melihat data histori nilai ini.');
        }
        return view('historiNilais.show', compact('historiNilai'));
    }

    public function edit(historiNilai $historiNilai)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh mengubah data histori nilai.');
        }

        $mahasiswas = Pengguna::where('role', 'mahasiswa')->get();
        $dosens = Pengguna::where('role', 'dosen')->get();
        $namaMataKuliahs = MataKuliah::all();

        return view('historiNilais.edit', compact('historiNilai','mahasiswas', 'dosens','namaMataKuliahs'));
    }

    public function update(Request $request, historiNilai $historiNilai)
    {
        $user = auth()->user();

        if ($user->isMahasiswa() || $user->isDosen() && $historiNilai->namaDosen !== $user->id ) {
            abort(403, 'Anda tidak boleh mengubah data histori nilai ini.');
        }

        if ($user->isAdmin()) {
            $request->validate([
                'nim'=>'required|exists:users,id',
                'namaDosen'=>'required|exists:users,id',
                'tahunAkademik'=>'required|integer|min:19591',
                'namaMataKuliah'=>'required|exists:mata_kuliahs,id',
                'bobot'=>'required|numeric|max:4.00',
            ]);
        } else {
            $request->validate([
                'bobot'=>'required|numeric|max:4.00',
            ]);
        }

        $bobot = $request->bobot;
        if ($bobot == 4.00) {
            $request['nilai'] = 'A';
        } elseif ($bobot >=  3.70) {
            $request['nilai'] = 'A-';
        } elseif ($bobot >= 3.40) {
            $request['nilai'] = 'B+';
        } elseif ($bobot >= 3.00) {
            $request['nilai'] = 'B';
        } elseif ($bobot >= 2.64) {
            $request['nilai'] = 'B-';
        } elseif ($bobot >= 2.35) {
            $request['nilai'] = 'C+';
        } elseif ($bobot >= 2.00) {
            $request['nilai'] = 'C';
        } elseif ($bobot >= 1.00) {
            $request['nilai'] = 'D';
        } else {
            $request['nilai'] = 'E';
        }

    $historiNilai->update($request->only(
            'nim',
            'namaDosen',
            'tahunAkademik',
            'namaMataKuliah',
            'nilai',
            'bobot'));
        return redirect()->route('historiNilai.index')->with('success', 'Data histori nilai diperbarui.');
    }

    public function destroy(historiNilai $historiNilai)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh menghapus data histori nilai.');
        }
        $historiNilai->delete();
        return redirect()->route('historiNilai.index')->with('success', 'Data histori nilai dihapus.');
    }
}
