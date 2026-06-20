<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\historiNilai;
use App\Models\Pengguna;
use App\Models\MataKuliah;

class HistoriNilaiSeeder extends Seeder
{
    public function run(): void
    {
        $dosen = Pengguna::where('role', 'dosen')->get();

        $mahasiswa = Pengguna::where('role', 'mahasiswa')->get();

        $mataKuliah = MataKuliah::get();

        historiNilai::create([
            'nim'           => $mahasiswa[0]->id,
            'namaDosen'     => $dosen[0]->id,
            'tahunAkademik' => '20252',
            'namaMataKuliah'=> $mataKuliah[0]->id,
            'nilai'         => 'A',
            'bobot'         => 4.00
        ]);
        historiNilai::create([
            'nim'           => $mahasiswa[0]->id,
            'namaDosen'     => $dosen[1]->id,
            'tahunAkademik' => '20252',
            'namaMataKuliah'=> $mataKuliah[1]->id,
            'nilai'         => 'B-',
            'bobot'         => 2.80
        ]);
        historiNilai::create([
            'nim'           => $mahasiswa[0]->id,
            'namaDosen'     => $dosen[2]->id,
            'tahunAkademik' => '20252',
            'namaMataKuliah'=> $mataKuliah[2]->id,
            'nilai'         => 'B+',
            'bobot'         => 3.50
        ]);
        historiNilai::create([
            'nim'           => $mahasiswa[1]->id,
            'namaDosen'     => $dosen[0]->id,
            'tahunAkademik' => '20252',
            'namaMataKuliah'=> $mataKuliah[0]->id,
            'nilai'         => 'A',
            'bobot'         => 4.00
        ]);
        historiNilai::create([
            'nim'           => $mahasiswa[1]->id,
            'namaDosen'     => $dosen[1]->id,
            'tahunAkademik' => '20252',
            'namaMataKuliah'=> $mataKuliah[1]->id,
            'nilai'         => 'A-',
            'bobot'         => 3.99
        ]);
        historiNilai::create([
            'nim'           => $mahasiswa[1]->id,
            'namaDosen'     => $dosen[2]->id,
            'tahunAkademik' => '20252',
            'namaMataKuliah'=> $mataKuliah[2]->id,
            'nilai'         => 'A',
            'bobot'         => 4.00
        ]);
        historiNilai::create([
            'nim'           => $mahasiswa[2]->id,
            'namaDosen'     => $dosen[0]->id,
            'tahunAkademik' => '20252',
            'namaMataKuliah'=> $mataKuliah[0]->id,
            'nilai'         => 'C',
            'bobot'         => 2.00
        ]);
        historiNilai::create([
            'nim'           => $mahasiswa[2]->id,
            'namaDosen'     => $dosen[1]->id,
            'tahunAkademik' => '20252',
            'namaMataKuliah'=> $mataKuliah[1]->id,
            'nilai'         => 'A',
            'bobot'         => 4.00
        ]);
        historiNilai::create([
            'nim'           => $mahasiswa[2]->id,
            'namaDosen'     => $dosen[2]->id,
            'tahunAkademik' => '20252',
            'namaMataKuliah'=> $mataKuliah[2]->id,
            'nilai'         => 'A',
            'bobot'         => 4.00
        ]);
    }
}