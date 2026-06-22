<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\nilaiHasil;
use App\Models\Pengguna;
use App\Models\MataKuliah;

class NilaiHasilSeeder extends Seeder
{
    public function run(): void
    {
        $dosen = Pengguna::where('role', 'dosen')->get();

        $mahasiswa = Pengguna::where('role', 'mahasiswa')->get();

        $mataKuliah = MataKuliah::get();

        $dataset = [
            [
                'nim'            => $mahasiswa[0]->id,
                'namaDosen'      => $dosen[0]->id,
                'tahunAkademik'  => '20252',
                'namaMataKuliah' => $mataKuliah[0]->id,
                'tugas'          => 100,
                'uts'            => 90,
                'uas'            => 100,
                'status'         => 'B',
            ],
            [
                'nim'            => $mahasiswa[0]->id,
                'namaDosen'      => $dosen[1]->id,
                'tahunAkademik'  => '20252',
                'namaMataKuliah' => $mataKuliah[1]->id,
                'tugas'          => 80,
                'uts'            => 80,
                'uas'            => 80,
                'status'         => 'B',
            ],
            [
                'nim'            => $mahasiswa[0]->id,
                'namaDosen'      => $dosen[2]->id,
                'tahunAkademik'  => '20252',
                'namaMataKuliah' => $mataKuliah[2]->id,
                'tugas'          => 50,
                'uts'            => 60,
                'uas'            => 70,
                'status'         => 'B',
            ],
            [
                'nim'            => $mahasiswa[0]->id,
                'namaDosen'      => $dosen[3]->id,
                'tahunAkademik'  => '20251',
                'namaMataKuliah' => $mataKuliah[3]->id,
                'tugas'          => 50,
                'uts'            => 60,
                'uas'            => 70,
                'status'         => 'B',
            ],
            [
                'nim'            => $mahasiswa[0]->id,
                'namaDosen'      => $dosen[4]->id,
                'tahunAkademik'  => '20251',
                'namaMataKuliah' => $mataKuliah[4]->id,
                'tugas'          => 100,
                'uts'            => 90,
                'uas'            => 70,
                'status'         => 'B',
            ],
            [
                'nim'            => $mahasiswa[1]->id,
                'namaDosen'      => $dosen[0]->id,
                'tahunAkademik'  => '20252',
                'namaMataKuliah' => $mataKuliah[0]->id,
                'tugas'          => 90,
                'uts'            => 85,
                'uas'            => 70,
                'status'         => 'B',
            ],
            [
                'nim'            => $mahasiswa[1]->id,
                'namaDosen'      => $dosen[1]->id,
                'tahunAkademik'  => '20252',
                'namaMataKuliah' => $mataKuliah[1]->id,
                'tugas'          => 70,
                'uts'            => 80,
                'uas'            => 70,
                'status'         => 'B',
            ],
            [
                'nim'            => $mahasiswa[1]->id,
                'namaDosen'      => $dosen[2]->id,
                'tahunAkademik'  => '20252',
                'namaMataKuliah' => $mataKuliah[2]->id,
                'tugas'          => 50,
                'uts'            => 60,
                'uas'            => 70,
                'status'         => 'B',
            ],
            [
                'nim'            => $mahasiswa[1]->id,
                'namaDosen'      => $dosen[3]->id,
                'tahunAkademik'  => '20251',
                'namaMataKuliah' => $mataKuliah[3]->id,
                'tugas'          => 50,
                'uts'            => 90,
                'uas'            => 40,
                'status'         => 'B',
            ],
            [
                'nim'            => $mahasiswa[1]->id,
                'namaDosen'      => $dosen[4]->id,
                'tahunAkademik'  => '20251',
                'namaMataKuliah' => $mataKuliah[4]->id,
                'tugas'          => 100,
                'uts'            => 90,
                'uas'            => 70,
                'status'         => 'B',
            ],
        ];

        foreach ($dataset as $data) {
            $nilaiAngka = ($data['tugas'] * 0.4 + $data['uts'] * 0.3 + $data['uas'] * 0.3);
            $data['nilaiAngka'] = $nilaiAngka;

            if ($nilaiAngka >= 80) {
                $data['nilaiHuruf'] = 'A';
                $data['bobotKualitas'] = 4.00;
            } elseif ($nilaiAngka >= 77) {
                $data['nilaiHuruf'] = 'A-';
                $data['bobotKualitas'] = 3.70 + ($nilaiAngka - 77) * 0.145;
            } elseif ($nilaiAngka >= 74) {
                $data['nilaiHuruf'] = 'B+';
                $data['bobotKualitas'] = 3.40 + ($nilaiAngka - 74) * 0.145;
            } elseif ($nilaiAngka >= 70) {
                $data['nilaiHuruf'] = 'B';
                $data['bobotKualitas'] = 3.00 + ($nilaiAngka - 70) * 0.13;
            } elseif ($nilaiAngka >= 65) {
                $data['nilaiHuruf'] = 'B-';
                $data['bobotKualitas'] = 2.64 + ($nilaiAngka - 65) * 0.0875;
            } elseif ($nilaiAngka >= 61) {
                $data['nilaiHuruf'] = 'C+';
                $data['bobotKualitas'] = 2.35 + ($nilaiAngka - 61) * 0.0934;
            } elseif ($nilaiAngka >= 56) {
                $data['nilaiHuruf'] = 'C';
                $data['bobotKualitas'] = 2.00 + ($nilaiAngka - 56) * 0.085;
            } elseif ($nilaiAngka >= 45) {
                $data['nilaiHuruf'] = 'D';
                $data['bobotKualitas'] = 1.00 + ($nilaiAngka - 45) * 0.099;
            } else {
                $data['nilaiHuruf'] = 'E';
                $data['bobotKualitas'] = 0.00;
            }

            if ($nilaiAngka >= 56) {
                $data['keterangan'] = 'Lulus';
            } else {
                $data['keterangan'] = 'Tidak Lulus';
            }

            $sksMatkul = MataKuliah::where('id', $data['namaMataKuliah'])->value('sks');
            $data['sks'] = $sksMatkul;

            $semuaDataLama = nilaiHasil::where('nim', $data['nim'])->get();
            $dataSemesterIni = $semuaDataLama->where('tahunAkademik', $data['tahunAkademik']);
            
            $sksLama = $semuaDataLama->sum('sks');
            $jumlahSKS = $sksLama + $data['sks'];
            $jumlahSKSSemester = $dataSemesterIni->sum('sks') + $data['sks'];
            $kreditPerolehanLama = $semuaDataLama->whereNotIn('nilaiHuruf', ['D', 'E'])->sum('sks');
            $kreditPerolehanBaru = (!in_array($data['nilaiHuruf'], ['D', 'E'])) ? $sksMatkul : 0;
            $kreditPeroleh = $kreditPerolehanLama + $kreditPerolehanBaru;

            $data['sksSemester'] = $jumlahSKSSemester;
            $data['kreditDiambil'] = $jumlahSKS;
            $data['kreditPeroleh'] = $kreditPeroleh;

            $totalMutuSemester = $dataSemesterIni->sum(function($item) {
                return $item->bobotKualitas * $item->sks;
            }) + ($data['bobotKualitas'] * $sksMatkul);
            
            $data['ips'] = $jumlahSKSSemester > 0 ? round($totalMutuSemester / $jumlahSKSSemester, 2) : 0.00;

            $totalMutuKumulatif = $semuaDataLama->sum(function($item) {
                return $item->bobotKualitas * $item->sks;
            }) + ($data['bobotKualitas'] * $sksMatkul);

            $data['ipk'] = $data['kreditDiambil'] > 0 ? round($totalMutuKumulatif / $data['kreditDiambil'], 2) : 0.00;
            
            nilaiHasil::create($data);
        }
    }
}