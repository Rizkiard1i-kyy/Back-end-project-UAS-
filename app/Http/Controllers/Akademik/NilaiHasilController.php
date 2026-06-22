<?php

namespace App\Http\Controllers\Akademik;

use App\Models\nilaiHasil;
use App\Models\Pengguna;
use App\Models\MataKuliah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NilaiHasilController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $akses = nilaiHasil::with(['mahasiswa','dosen','mataKuliah']);
        
        if ($user->isMahasiswa()) {
            $akses->where('nim', $user->id);
        } elseif ($user->isDosen()) {
            $akses->where('namaDosen', $user->id);
        }

        if ($request->filled('tahunAkademik')) {
            $akses->where('tahunAkademik', $request->tahunAkademik);
        }

        $nilaiHasil = $akses->get();
        $nilaiKumulatif = null;
        if ($nilaiHasil->isNotEmpty()) {
            $nimMahasiswa = $nilaiHasil->first()->nim;
            $seluruhRiwayat = nilaiHasil::where('nim', $nimMahasiswa)->get();
            if ($seluruhRiwayat->isNotEmpty()) {
                $dataTerakhirAsli = $seluruhRiwayat->sortBy('id')->last();
                $nilaiKumulatif = (object)[
                    'kreditDiambil' => $dataTerakhirAsli->kreditDiambil,
                    'kreditPeroleh' => $dataTerakhirAsli->kreditPeroleh,
                    'ipk'           => $dataTerakhirAsli->ipk,
                ];
            }
        }
        return view('nilaiHasils.index', compact('nilaiHasil', 'nilaiKumulatif'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh membuat data nilai KHS.');
        }

        $mahasiswas = Pengguna::where('role', 'mahasiswa')->get();
        $dosens = Pengguna::where('role', 'dosen')->get();
        $namaMataKuliahs = MataKuliah::all();

        return view('nilaiHasils.create', compact('mahasiswas', 'dosens','namaMataKuliahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim'           =>'required|exists:users,id',
            'namaDosen'     =>'required|exists:users,id',
            'tahunAkademik' =>'required|integer|min:19591',
            'namaMataKuliah'=>'required|exists:mata_kuliahs,id',
            'tugas'         =>'required|integer|between:0,100',
            'uts'           =>'required|integer|between:0,100',
            'uas'           =>'required|integer|between:0,100',
            'status'        =>'required|string|max:1',
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

        $sksMatkul = MataKuliah::where('id', $request->namaMataKuliah)->value('sks');
        $request['sks'] = $sksMatkul;

        $semuaDataLama = nilaiHasil::where('nim', $request->nim)->get();
        $dataSemesterIni = $semuaDataLama->where('tahunAkademik', $request->tahunAkademik);
        
        $sksLama = $semuaDataLama->where('nim', $request->nim)->sum('sks');
        $jumlahSKS = $sksLama + $request->sks;
        $jumlahSKSSemester = $dataSemesterIni->sum('sks') + $request->sks;
        $kreditPerolehanLama = $semuaDataLama->whereNotIn('nilaiHuruf', ['D', 'E'])->sum('sks');
        $kreditPerolehanBaru = ($request['nilaiHuruf'] !== 'D' && $request['nilaiHuruf'] !== 'E' ) ? $sksMatkul : 0;
        $kreditPeroleh = $kreditPerolehanLama + $kreditPerolehanBaru;

        $request['sksSemester'] = $jumlahSKSSemester;
        $request['kreditDiambil'] = $jumlahSKS;
        $request['kreditPeroleh'] = $kreditPeroleh;

        $totalMutuSemester = $dataSemesterIni->sum(function($item) {
            return $item->bobotKualitas * $item->sks;
        }) + ($request['bobotKualitas'] * $sksMatkul);
        
        $request['ips'] = $jumlahSKSSemester > 0 ? round($totalMutuSemester / $jumlahSKSSemester, 2) : 0.00;

        $totalMutuKumulatif = $semuaDataLama->sum(function($item) {
            return $item->bobotKualitas * $item->sks;
        }) + ($request['bobotKualitas'] * $sksMatkul);

        $request['ipk'] = $request->kreditDiambil > 0 ? round($totalMutuKumulatif / $request->kreditDiambil, 2) : 0.00;
        
        nilaiHasil::create($request->only(
            'nim',
            'namaDosen',
            'tahunAkademik',
            'namaMataKuliah',
            'tugas',
            'uts',
            'uas',
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
        
        return redirect()->route('nilaiHasil.index')->with('success', 'Data nilai KHS baru dibuat.');
    }

    public function show(nilaiHasil $nilaiHasil)
    {
        $user = auth()->user();

        if ($user->isMahasiswa() && (int)$nilaiHasil->nim !== $user->id) {
            abort(403, 'Anda tidak bisa melihat data  nilai KHS mahasiswa lain.');
        }

        if ($user->isDosen() && (int)$nilaiHasil->namaDosen !== $user->id) {
            abort(403, 'Anda tidak bisa melihat data nilai KHS ini.');
        }
        return view('nilaiHasils.show', compact('nilaiHasil'));
    }

    public function edit(nilaiHasil $nilaiHasil)
    {
         $user = auth()->user();

        if ($user->isMahasiswa() || $user->isDosen() && (int)$nilaiHasil->namaDosen !== $user->id ) {
            abort(403, 'Anda tidak boleh mengubah data nilai KHS ini.');
        }

        $mahasiswas = Pengguna::where('role', 'mahasiswa')->get();
        $dosens = Pengguna::where('role', 'dosen')->get();
        $namaMataKuliahs = MataKuliah::all();

        return view('nilaiHasils.edit', compact('nilaiHasil','mahasiswas', 'dosens','namaMataKuliahs'));
    }

    public function update(Request $request, nilaiHasil $nilaiHasil)
    {
        $user = auth()->user();

        if ($user->isMahasiswa() || $user->isDosen() && (int)$nilaiHasil->namaDosen !== $user->id ) {
            abort(403, 'Anda tidak boleh mengubah data nilai KHS ini.');
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

        $namaMataKuliah = $request->input('namaMataKuliah', $nilaiHasil->namaMataKuliah);
        $nimMahasiswa = $request->input('nim', $nilaiHasil->nim);
        $tahunAkademik = $request->input('tahunAkademik', $nilaiHasil->tahunAkademik);

        $sksMatkul = MataKuliah::where('id', $namaMataKuliah)->value('sks');
        $request['sks'] = $sksMatkul;

        $semuaDataLama = nilaiHasil::where('nim', $request->nim)->get();
        $dataSemesterIni = $semuaDataLama->where('tahunAkademik', $request->tahunAkademik);
        
        $sksLama = $semuaDataLama->where('nim', $request->nim)->sum('sks');
        $jumlahSKS = $sksLama + $request->sks;
        $jumlahSKSSemester = $dataSemesterIni->sum('sks') + $request->sks;
        $kreditPerolehanLama = $semuaDataLama->whereNotIn('nilaiHuruf', ['D', 'E'])->sum('sks');
        $kreditPerolehanBaru = ($request['nilaiHuruf'] !== 'D' && $request['nilaiHuruf'] !== 'E' ) ? $sksMatkul : 0;
        $kreditPeroleh = $kreditPerolehanLama + $kreditPerolehanBaru;

        $request['sksSemester'] = $jumlahSKSSemester;
        $request['kreditDiambil'] = $jumlahSKS;
        $request['kreditPeroleh'] = $kreditPeroleh;

        $totalMutuSemester = $dataSemesterIni->sum(function($item) {
            return $item->bobotKualitas * $item->sks;
        }) + ($request['bobotKualitas'] * $sksMatkul);
        
        $request['ips'] = $jumlahSKSSemester > 0 ? round($totalMutuSemester / $jumlahSKSSemester, 2) : 0.00;

        $totalMutuKumulatif = $semuaDataLama->sum(function($item) {
            return $item->bobotKualitas * $item->sks;
        }) + ($request['bobotKualitas'] * $sksMatkul);

        $request['ipk'] = $request->kreditDiambil > 0 ? round($totalMutuKumulatif / $request->kreditDiambil, 2) : 0.00;
        
        $nilaiHasil->update($request->only(
            'nim',
            'namaDosen',
            'tahunAkademik',
            'namaMataKuliah',
            'tugas',
            'uts',
            'uas',
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
        return redirect()->route('nilaiHasil.index')->with('success', 'Data nilai kHS diperbarui');
    }

    public function destroy(nilaiHasil $nilaiHasil)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh menghapus data nilai KHS.');
        }
        $nimMahasiswa = $nilaiHasil->nim;
        $nilaiHasil->delete();

        $dataTersisa = nilaiHasil::where('nim', $nimMahasiswa)->get();
        $sksKumulatif = 0;
        $kreditPerolehKumulatif = 0;
        $totalMutuKumulatif = 0;

        foreach ($dataTersisa as $data) {
            $sksMatkul = $data->sks;
            $sksKumulatif += $sksMatkul;
            if (!in_array($data->nilaiHuruf, ['D', 'E'])) {
                $kreditPerolehKumulatif += $sksMatkul;
            }
            $totalMutuKumulatif += ($data->bobotKualitas * $sksMatkul);
            $ipkBaru = $sksKumulatif > 0 ? round($totalMutuKumulatif / $sksKumulatif, 2) : 0.00;
            $data->update([
                'kreditDiambil' => $sksKumulatif,
                'kreditPeroleh' => $kreditPerolehKumulatif,
                'ipk'           => $ipkBaru
            ]);
        }
        return redirect()->route('nilaiHasil.index')->with('success', 'Data nilai KHS dihapus.');
    }
}
