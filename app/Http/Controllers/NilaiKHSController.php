<?php

namespace App\Http\Controllers;

use App\Models\nilaiKHS;
use App\Models\Pengguna;
use App\Models\MataKuliah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NilaiKHSController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $akses = nilaiKHS::with(['mahasiswa','dosen','mataKuliah']);
        
        if ($user->isMahasiswa()) {
            $akses->where('nim', $user->id);
        } elseif ($user->isDosen()) {
            $akses->where('namaDosen', $user->id);
        }

        $nilaiKHS = $akses->get();
        return view('nilaiKHSs.index', compact('nilaiKHS'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh membuat data nilai KHS.');
        }

        $mahasiswas = Pengguna::where('role', 'mahasiswa')->get();
        $dosens = Pengguna::where('role', 'dosen')->get();
        $namaMataKuliahs = MataKuliah::all();

        return view('nilaiKHSs.create', compact('mahasiswas', 'dosens','namaMataKuliahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim'=>'required|exists:users,id',
            'namaDosen'=>'required|exists:users,id',
            'tahunAkademik'=>'required|integer|min:19591',
            'namaMataKuliah'=>'required|exists:mata_kuliahs,id',
            'tugas' =>'required|integer|between:0,100',
            'uts' =>'required|integer|between:0,100',
            'uas' =>'required|integer|between:0,100',
            'status'=>'required|string|max:1',
        ]);

        $nilaiAngka = ($request->tugas * 0.4 + $request->uts * 0.3 + $request->uas * 0.3);
        $request['nilaiAngka'] = $nilaiAngka;
        if ($nilaiAngka >= 80) {
            $request['nilaiHuruf'] = 'A';
            $request['bobotKualitas'] = 4.00;
        } elseif ($nilaiAngka >= 77) {
            $request['nilaiHuruf'] = 'A-';
            $request['bobotKualitas'] = 3.70 + ($request->nilaiAngka - 77) * 0.145;
        } elseif ($nilaiAngka >= 74) {
            $request['nilaiHuruf'] = 'B+';
            $request['bobotKualitas'] = 3.40 + ($request->nilaiAngka - 74) * 0.145;
        } elseif ($nilaiAngka >= 70) {
            $request['nilaiHuruf'] = 'B';
            $request['bobotKualitas'] = 3.00 + ($request->nilaiAngka - 70) * 0.13;
        } elseif ($nilaiAngka >= 65) {
            $request['nilaiHuruf'] = 'B-';
            $request['bobotKualitas'] = 2.64 + ($request->nilaiAngka - 65) * 0.0875;
        } elseif ($nilaiAngka >= 61) {
            $request['nilaiHuruf'] = 'C+';
            $request['bobotKualitas'] = 2.35 + ($request->nilaiAngka - 61) * 0.0934;
        } elseif ($nilaiAngka >= 56) {
            $request['nilaiHuruf'] = 'C';
            $request['bobotKualitas'] = 2.00 + ($request->nilaiAngka - 56) * 0.085;
        } elseif ($nilaiAngka >= 45) {
            $request['nilaiHuruf'] = 'D';
            $request['bobotKualitas'] = 1.00 + ($request->nilaiAngka - 45) * 0.099;
        } else {
            $request['nilaiHuruf'] = 'E';
            $request['bobotKualitas'] = 0.00;
        }

        if ($nilaiAngka >= 56) {
            $request['keterangan'] = 'Lulus';
        } else {
            $request['keterangan'] = 'Tidak Lulus';
        }

        $semuaDataLama = nilaiKHS::where('nim', $request->nim)->get();
        $dataSemesterIni = $semuaDataLama->where('tahunAkademik', $request->tahunAkademik);
        $sksMatkul = MataKuliah::where('id', $request->namaMataKuliah)->value('sks');
        $request['sks'] = $sksMatkul;
        
        $sksLama = $semuaDataLama->where('nim', $request->nim)->sum('sks');
        $jumlahSKS = $sksLama + $request->sks;
        $jumlahSKSSemester = $dataSemesterIni->sum('sks') + $request->sks;;
        $kreditPerolehanLama = $semuaDataLama->whereNotIn('nilaiHuruf', ['D', 'E'])->sum('sks');
        $kreditPerolehanBaru = ($request['nilaiHuruf'] !== 'D' && $request['nilaiHuruf'] !== 'E' ) ? $request->sks : 0;
        $kreditPeroleh = $kreditPerolehanLama + $kreditPerolehanBaru;

        $request['sksSemester'] = $jumlahSKSSemester;
        $request['kreditDiambil'] = $jumlahSKS;
        $request['kreditPeroleh'] = $kreditPeroleh;
        
        $totalMutuSemester = $dataSemesterIni->sum(function($item) {
            return $item->bobotKualitas * $item->sks;
        }) + ($request['bobotKualitas'] * $request->sks);
        
        $request['ips'] = $jumlahSKSSemester > 0 ? round($totalMutuSemester / $jumlahSKSSemester, 2) : 0.00;

        $totalMutuKumulatif = $semuaDataLama->sum(function($item) {
            return $item->bobotKualitas * $item->sks;
        }) + ($request['bobotKualitas'] * $request->sks);

        $request['ipk'] = $request->kreditDiambil > 0 ? round($totalMutuKumulatif / $request->kreditDiambil, 2) : 0.00;
        
        nilaiKHS::create($request->only(
            'nim',
            'tahunAkademik',
            'tugas',
            'uts',
            'uas',
            'namaMataKuliah',
            'status',
            'nilaiHuruf',
            'nilaiAngka',
            'bobotKualitas',
            'keterangan',
            'sks',
            'sksSemester',
            'ips',
            'kreditDiambil',
            'kreditPeroleh',
            'ipk',
        ));
        
        return redirect()->route('nilaiKHS.index')->with('success', 'Data nilai KHS baru dibuat.');
    }

    public function show(nilaiKHS $nilaiKHS)
    {
        $user = auth()->user();

        if ($user->isMahasiswa() && $nilaiKHS->nim !== $user->id) {
            abort(403, 'Anda tidak bisa melihat data  nilai KHS mahasiswa lain.');
        }

        if ($user->isDosen() && $nilaiKHS->namaDosen !== $user->id) {
            abort(403, 'Anda tidak bisa melihat data nilai KHS ini.');
        }
        return view('nilaiKHSs.show', compact('nilaiKHS'));
    }

    public function edit(nilaiKHS $nilaiKHS)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh mengubah data nilai KHS.');
        }

        $mahasiswas = Pengguna::where('role', 'mahasiswa')->get();
        $dosens = Pengguna::where('role', 'dosen')->get();
        $namaMataKuliahs = MataKuliah::all();

        return view('nilaiKHSs.edit', compact('nilaiKHS','mahasiswas', 'dosens','namaMataKuliahs'));
    }

    public function update(Request $request, nilaiKHS $nilaiKHS)
    {
        $user = auth()->user();

        if ($user->isMahasiswa() || $user->isDosen() && $nilaiKHS->namaDosen !== $user->id ) {
            abort(403, 'Anda tidak boleh mengubah data  nilai KHS ini.');
        }

        if ($user->isAdmin()) {
            $request->validate([
                'nim'=>'required|exists:users,id',
                'namaDosen'=>'required|exists:users,id',
                'tahunAkademik'=>'required|integer|min:19591',
                'namaMataKuliah'=>'required|exists:mata_kuliahs,id',
                'tugas' =>'required|integer|between:0,100',
                'uts' =>'required|integer|between:0,100',
                'uas' =>'required|integer|between:0,100',
                'status'=>'required|string|max:1',
            ]);
        } else {
            $request->validate([
                'tugas' =>'required|integer|between:0,100',
                'uts' =>'required|integer|between:0,100',
                'uas' =>'required|integer|between:0,100',
            ]);
        }

        $nilaiAngka = ($request->tugas * 0.4 + $request->uts * 0.3 + $request->uas * 0.3);
        $request['nilaiAngka'] = $nilaiAngka;
        if ($nilaiAngka >= 80) {
            $request['nilaiHuruf'] = 'A';
            $request['bobotKualitas'] = 4.00;
        } elseif ($nilaiAngka >= 77) {
            $request['nilaiHuruf'] = 'A-';
            $request['bobotKualitas'] = 3.70 + ($request->nilaiAngka - 77) * 0.145;
        } elseif ($nilaiAngka >= 74) {
            $request['nilaiHuruf'] = 'B+';
            $request['bobotKualitas'] = 3.40 + ($request->nilaiAngka - 74) * 0.145;
        } elseif ($nilaiAngka >= 70) {
            $request['nilaiHuruf'] = 'B';
            $request['bobotKualitas'] = 3.00 + ($request->nilaiAngka - 70) * 0.13;
        } elseif ($nilaiAngka >= 65) {
            $request['nilaiHuruf'] = 'B-';
            $request['bobotKualitas'] = 2.64 + ($request->nilaiAngka - 65) * 0.0875;
        } elseif ($nilaiAngka >= 61) {
            $request['nilaiHuruf'] = 'C+';
            $request['bobotKualitas'] = 2.35 + ($request->nilaiAngka - 61) * 0.0934;
        } elseif ($nilaiAngka >= 56) {
            $request['nilaiHuruf'] = 'C';
            $request['bobotKualitas'] = 2.00 + ($request->nilaiAngka - 56) * 0.085;
        } elseif ($nilaiAngka >= 45) {
            $request['nilaiHuruf'] = 'D';
            $request['bobotKualitas'] = 1.00 + ($request->nilaiAngka - 45) * 0.099;
        } else {
            $request['nilaiHuruf'] = 'E';
            $request['bobotKualitas'] = 0.00;
        }

        if ($nilaiAngka >= 56) {
            $request['keterangan'] = 'Lulus';
        } else {
            $request['keterangan'] = 'Tidak Lulus';
        }

        $semuaDataLama = nilaiKHS::where('nim', $request->nim)->get();
        $dataSemesterIni = $semuaDataLama->where('tahunAkademik', $request->tahunAkademik);
        $sksMatkul = MataKuliah::where('id', $request->namaMataKuliah)->value('sks');
        $request['sks'] = $sksMatkul;
        
        $sksLama = $semuaDataLama->where('nim', $request->nim)->sum('sks');
        $jumlahSKS = $sksLama + $request->sks;
        $jumlahSKSSemester = $dataSemesterIni->sum('sks') + $request->sks;;
        $kreditPerolehanLama = $semuaDataLama->whereNotIn('nilaiHuruf', ['D', 'E'])->sum('sks');
        $kreditPerolehanBaru = ($request['nilaiHuruf'] !== 'D' && $request['nilaiHuruf'] !== 'E' ) ? $request->sks : 0;
        $kreditPeroleh = $kreditPerolehanLama + $kreditPerolehanBaru;

        $request['sksSemester'] = $jumlahSKSSemester;
        $request['kreditDiambil'] = $jumlahSKS;
        $request['kreditPeroleh'] = $kreditPeroleh;

        $totalMutuSemester = $dataSemesterIni->sum(function($item) {
            return $item->bobotKualitas * $item->sks;
        }) + ($request['bobotKualitas'] * $request->sks);
        
        $request['ips'] = $jumlahSKSSemester > 0 ? round($totalMutuSemester / $jumlahSKSSemester, 2) : 0.00;

        $totalMutuKumulatif = $semuaDataLama->sum(function($item) {
            return $item->bobotKualitas * $item->sks;
        }) + ($request['bobotKualitas'] * $request->sks);

        $request['ipk'] = $request->kreditDiambil > 0 ? round($totalMutuKumulatif / $request->kreditDiambil, 2) : 0.00;
        
        $nilaiKHS->update($request->only(
            'nim',
            'tahunAkademik',
            'tugas',
            'uts',
            'uas',
            'namaMataKuliah',
            'status',
            'nilaiHuruf',
            'nilaiAngka',
            'bobotKualitas',
            'keterangan',
            'sks',
            'sksSemester',
            'ips',
            'kreditDiambil',
            'kreditPeroleh',
            'ipk',
        ));
        return redirect()->route('nilaiKHS.index')->with('success', 'Data nilai kHS diperbarui');
    }

    public function destroy(nilaiKHS $nilaiKHS)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh menghapus data nilai KHS.');
        }
        $nilaiKHS->delete();
        return redirect()->route('nilaiKHS.index')->with('success', 'Data nilai KHS dihapus.');
    }
}
