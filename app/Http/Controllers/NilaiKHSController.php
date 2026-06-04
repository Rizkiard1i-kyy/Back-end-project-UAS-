<?php

namespace App\Http\Controllers;

use App\Models\nilaiKHS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NilaiKHSController extends Controller
{
    public function index()
    {
        $nilaiKHS = nilaiKHS::all();
        return view('nilaiKHSs.index', compact('nilaiKHS'));
    }

    public function create()
    {
        return view('nilaiKHSs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim'=>'required|string|max:9',
            'tahunAkademik'=>'required|integer|min:19591',
            'tugas' =>'required|integer|between:0,100',
            'uts' =>'required|integer|between:0,100',
            'uas' =>'required|integer|between:0,100',
            'kodeMK'=>'required|string|min:1',
            'namaMataKuliah'=>'required|string|max:255',
            'status'=>'required|string|max:1',
            'sks'=>'required|integer|min:1',
            'keterangan'=>'required|string|max:40',
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

        $semuaDataLama = nilaiKHS::where('nim', $request->nim)->get();

        $sksSebelumnya = $semuaDataLama->sum('sks');
        $jumlahSKS = $sksSebelumnya + $request->sks;
        $request['jumlahSKS'] = $jumlahSKS;

        $kreditDiambil = $sksSebelumnya + $request->sks;

        $kreditPerolehanLama = $semuaDataLama->where('nilaiHuruf', '!=', 'E')->sum('sks');
        $kreditPerolehanBaru = ($request['nilaiHuruf'] !== 'E') ? $request->sks : 0;
        $kreditPeroleh = $kreditPerolehanLama + $kreditPerolehanBaru;

        $request['kreditDiambil'] = $kreditDiambil;
        $request['kreditPeroleh'] = $kreditPeroleh;

        $dataSemesterIni = $semuaDataLama->where('tahunAkademik', $request->tahunAkademik);
        $totalSksSemester = $dataSemesterIni->sum('sks') + $request->sks;
        $totalMutuSemester = $dataSemesterIni->sum(function($item) {
            return $item->bobotKualitas * $item->sks;
        }) + ($request['bobotKualitas'] * $request->sks);
        
        $request['ips'] = $totalSksSemester > 0 ? round($totalMutuSemester / $totalSksSemester, 2) : 0.00;

        $totalMutuKumulatif = $semuaDataLama->sum(function($item) {
            return $item->bobotKualitas * $item->sks;
        }) + ($request['bobotKualitas'] * $request->sks);

        $request['ipk'] = $kreditDiambil > 0 ? round($totalMutuKumulatif / $kreditDiambil, 2) : 0.00;
        
        nilaiKHS::create($request->only(
            'nim',
            'tahunAkademik',
            'tugas',
            'uts',
            'uas',
            'kodeMK',
            'namaMataKuliah',
            'status',
            'sks',
            'nilaiHuruf',
            'nilaiAngka',
            'bobotKualitas',
            'keterangan',
            'jumlahSKS',
            'ips',
            'kreditDiambil',
            'kreditPeroleh',
            'ipk',
        ));
        
        return redirect()->route('nilaiKHS.index')->with('success', 'Data nilai KHS baru dibuat.');
    }

    public function show(nilaiKHS $nilaiKHS)
    {
        return view('nilaiKHSs.show', compact('nilaiKHS'));
    }

    public function edit(nilaiKHS $nilaiKHS)
    {
        return view('nilaiKHSs.edit', compact('nilaiKHS'));
    }

    public function update(Request $request, nilaiKHS $nilaiKHS)
    {
        $request->validate([
            'nim'=>'required|string|max:9',
            'tahunAkademik'=>'required|integer|min:19591',
            'tugas' =>'required|integer|between:0,100',
            'uts' =>'required|integer|between:0,100',
            'uas' =>'required|integer|between:0,100',
            'kodeMK'=>'required|string|min:1',
            'namaMataKuliah'=>'required|string|max:255',
            'status'=>'required|string|max:1',
            'sks'=>'required|integer|min:1',
            'keterangan'=>'required|string|max:300',
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

        $semuaDataLama = nilaiKHS::where('nim', $request->nim)->get();

        $sksSebelumnya = $semuaDataLama->sum('sks');
        $jumlahSKS = $sksSebelumnya + $request->sks;
        $request['jumlahSKS'] = $jumlahSKS;

        $kreditDiambil = $sksSebelumnya + $request->sks;

        $kreditPerolehanLama = $semuaDataLama->where('nilaiHuruf', '!=', 'E')->sum('sks');
        $kreditPerolehanBaru = ($request['nilaiHuruf'] !== 'E') ? $request->sks : 0;
        $kreditPeroleh = $kreditPerolehanLama + $kreditPerolehanBaru;

        $request['kreditDiambil'] = $kreditDiambil;
        $request['kreditPeroleh'] = $kreditPeroleh;

        $dataSemesterIni = $semuaDataLama->where('tahunAkademik', $request->tahunAkademik);
        $totalSksSemester = $dataSemesterIni->sum('sks') + $request->sks;
        $totalMutuSemester = $dataSemesterIni->sum(function($item) {
            return $item->bobotKualitas * $item->sks;
        }) + ($request['bobotKualitas'] * $request->sks);
        
        $request['ips'] = $totalSksSemester > 0 ? round($totalMutuSemester / $totalSksSemester, 2) : 0.00;

        $totalMutuKumulatif = $semuaDataLama->sum(function($item) {
            return $item->bobotKualitas * $item->sks;
        }) + ($request['bobotKualitas'] * $request->sks);

        $request['ipk'] = $kreditDiambil > 0 ? round($totalMutuKumulatif / $kreditDiambil, 2) : 0.00;

        nilaiKHS::update($request->only(
            'nim',
            'tahunAkademik',
            'tugas',
            'uts',
            'uas',
            'kodeMK',
            'namaMataKuliah',
            'status',
            'sks',
            'nilaiHuruf',
            'nilaiAngka',
            'bobotKualitas',
            'keterangan',
            'jumlahSKS',
            'ips',
            'kreditDiambil',
            'kreditPeroleh',
            'ipk'
        ,));

        return redirect()->route('nilaiKHS.index')->with('success', 'Data nilai kHS diperbarui');
    }

    public function destroy(nilaiKHS $nilaiKHS)
    {
        $nilaiKHS->delete();
        return redirect()->route('nilaiKHS.index')->with('success', 'Data nilai KHS dihapus.');
    }
}
