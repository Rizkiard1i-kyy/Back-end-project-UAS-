<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jadwal;
use App\Models\Pengguna;
use App\Models\MataKuliah;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $dosen = Pengguna::where('role', 'dosen')->get();

        if ($dosen->count() < 3) {
            return;
        }

        $mataKuliah = MataKuliah::get();

        Jadwal::create([
            'tahun_akademik' => 'Genap 2025',
            'matkul'         => $mataKuliah[0]->id,
            'kelas'          => 'C',
            'dosenPengajar'  => $dosen[0]->id,
            'ruangDanWaktu'  => 'R0902 / SENIN(15:30 s/d 17:10) SENIN(13:30 s/d 15:10)',
            'kodeMSteams'    => 'fw6rs2q',
        ]);

        Jadwal::create([
            'tahun_akademik' => 'Genap 2025',
            'matkul'         => $mataKuliah[1]->id,
            'kelas'          => 'C',
            'dosenPengajar'  => $dosen[1]->id,
            'ruangDanWaktu'  => 'R0902 / SENIN(07:30 s/d 09:10)',
            'kodeMSteams'    => 'u2nxns8',
        ]);

        Jadwal::create([
            'tahun_akademik' => 'Genap 2025',
            'matkul'         => $mataKuliah[2]->id,
            'kelas'          => 'C',
            'dosenPengajar'  => $dosen[2]->id,
            'ruangDanWaktu'  => 'R0701 / KAMIS(07:30 s/d 09:10) R0902 / JUMAT(09:30 s/d 11:10)',
            'kodeMSteams'    => '6y8kq21',
        ]);

        Jadwal::create([
            'tahun_akademik' => 'Gasal 2025',
            'matkul'         => $mataKuliah[6]->id,
            'kelas'          => 'C',
            'dosenPengajar'  => $dosen[3]->id,
            'ruangDanWaktu'  => 'R0704 / JUMAT(13:30 s/d 15:10) JUMAT(15:30 s/d 17:10)',
            'kodeMSteams'    => 'jh24062',
        ]);
    }
}
