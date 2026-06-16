<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        Jadwal::create([
            'tahun_akademik' => 'Gasal 2025',
            'kodeMK'         => 'TK13021',
            'namaMK'         => 'DATABASE SYSTEMS',
            'sks'            => 4,
            'kelas'          => 'C',
            'dosenPengajar'  => '10813002 TENY HANDHAYANI, S.Kom., M.Kom., Ph.D.',
            'ruangDanWaktu'  => 'R0705 / SELASA(13:30 s/d 15:10) SELASA(15:30 s/d 17:10)',
            'kodeMSteams'    => 'fa3x0wk',
            'emailDosen'     => 'tenyh@fti.untar.ac.id'
        ]);
        Jadwal::create([
            'tahun_akademik' => 'Gasal 2025',
            'kodeMK'         => 'TK13027',
            'namaMK'         => 'ALGORITHMS',
            'sks'            => 4,
            'kelas'          => 'C',
            'dosenPengajar'  => '10390001 JEANNY PRAGANTHA, Ir., M.Eng',
            'ruangDanWaktu'  => 'R0902 / SELASA(09:30 s/d 11:10)',
            'kodeMSteams'    => 'haudwk0',
            'emailDosen'     => 'jeannyp@fti.untar.ac.id'
        ]);
        Jadwal::create([
            'tahun_akademik' => 'Gasal 2025',
            'kodeMK'         => 'TK13028',
            'namaMK'         => 'FUNDAMENTAL PROGRAMMING',
            'sks'            => 4,
            'kelas'          => 'C',
            'dosenPengajar'  => '10813002 TENY HANDHAYANI, S.Kom., M.Kom., Ph.D.',
            'ruangDanWaktu'  => 'R0703 / SENIN(09:30 s/d 11:10) SENIN(07:30 s/d 09:10)',
            'kodeMSteams'    => '2d5e3at',
            'emailDosen'     => 'tenyh@fti.untar.ac.id'
        ]);
        Jadwal::create([
            'tahun_akademik' => 'Gasal 2025',
            'kodeMK'         => 'TK13032',
            'namaMK'         => 'TECHNOLOGY AND ETHICS',
            'sks'            => 4,
            'kelas'          => 'C',
            'dosenPengajar'  => '10119008 HERMAN TUSIADI, S.Kom., M.M',
            'ruangDanWaktu'  => 'R0704 / JUMAT(13:30 s/d 15:10) JUMAT(15:30 s/d 17:10)',
            'kodeMSteams'    => 'jh24062',
            'emailDosen'     => 'hermant@fti.untar.ac.id'
        ]);
        Jadwal::create([
            'tahun_akademik' => 'Gasal 2025',
            'kodeMK'         => 'TK13036',
            'namaMK'         => 'STATISTICS',
            'sks'            => 2,
            'kelas'          => 'C',
            'dosenPengajar'  => '10189013 DYAH ERNY HERWINDIATI, Prof., Ir., M.Si, Dr.',
            'ruangDanWaktu'  => 'R0801 / KAMIS(13:30 s/d 15:10)',
            'kodeMSteams'    => 'ghvu8q8',
            'emailDosen'     => 'dyahh@fti.untar.ac.id'
        ]);
        Jadwal::create([
            'tahun_akademik' => 'Gasal 2025',
            'kodeMK'         => 'TK13037',
            'namaMK'         => 'CALCULUS',
            'sks'            => 2,
            'kelas'          => 'C',
            'dosenPengajar'  => '10816004 TRI SUTRISNO, S.Si., M.Sc.',
            'ruangDanWaktu'  => 'R0704 / SENIN(13:30 s/d 15:10)',
            'kodeMSteams'    => null,
            'emailDosen'     => 'tris@fti.untar.ac.id'
        ]);
     Jadwal::create([
            'tahun_akademik' => 'Genap 2025',
            'kodeMK'         => 'TK13030',
            'namaMK'         => 'NUMERICAL METHOD',
            'sks'            => 4,
            'kelas'          => 'C',
            'dosenPengajar'  => '10812001 JANSON HENDRYLI, S. Kom. M.Kom.',
            'ruangDanWaktu'  => 'R0902 / SENIN(15:30 s/d 17:10) SENIN(13:30 s/d 15:10)',
            'kodeMSteams'    => 'fw6rs2q',
            'emailDosen'     => 'jansonh@fti.untar.ac.id'
        ]);
        Jadwal::create([
            'tahun_akademik' => 'Genap 2025',
            'kodeMK'         => 'TK13034',
            'namaMK'         => 'OPERATING SYSTEMS',
            'sks'            => 2,
            'kelas'          => 'C',
            'dosenPengajar'  => '10823004 IRVAN LEWENUSA, S.Kom., M.Kom.',
            'ruangDanWaktu'  => 'R0902 / SENIN(07:30 s/d 09:10)',
            'kodeMSteams'    => 'u2nxns8',
            'emailDosen'     => 'irvanl@fti.untar.ac.id'
        ]);
        Jadwal::create([
            'tahun_akademik' => 'Genap 2025',
            'kodeMK'         => 'TK13038',
            'namaMK'         => 'ALGEBRA & DISCRETE MATHEMATICS',
            'sks'            => 4,
            'kelas'          => 'C',
            'dosenPengajar'  => '10301015 LELY HIRYANTO, ST., M.Sc.,Ph.D.',
            'ruangDanWaktu'  => 'R0701 / KAMIS(07:30 s/d 09:10) R0902 / JUMAT(09:30 s/d 11:10)',
            'kodeMSteams'    => '6y8kq21',
            'emailDosen'     => 'lelyh@fti.untar.ac.id'
        ]);
        Jadwal::create([
            'tahun_akademik' => 'Genap 2025',
            'kodeMK'         => 'TK13039',
            'namaMK'         => 'INTRODUCTION TO ARTIFICIAL INTELLIGENCE',
            'sks'            => 2,
            'kelas'          => 'C',
            'dosenPengajar'  => '10805002 VINY CHRISTANTI MAWARDI, S.Kom., M.Kom.',
            'ruangDanWaktu'  => 'R0902 / SELASA(07:30 s/d 09:10)',
            'kodeMSteams'    => 'u72znbo',
            'emailDosen'     => 'vinym@fti.untar.ac.id'
        ]);
        Jadwal::create([
            'tahun_akademik' => 'Genap 2025',
            'kodeMK'         => 'TK23007',
            'namaMK'         => 'DATA STRUCTURES',
            'sks'            => 4,
            'kelas'          => 'C',
            'dosenPengajar'  => '10390001 JEANNY PRAGANTHA, Ir., M.Eng',
            'ruangDanWaktu'  => 'R0901 / KAMIS(13:30 s/d 15:10) KAMIS(15:30 s/d 17:10)',
            'kodeMSteams'    => '8gt3m7s',
            'emailDosen'     => 'jeannyp@fti.untar.ac.id'
        ]);
        Jadwal::create([
            'tahun_akademik' => 'Genap 2025',
            'kodeMK'         => 'TK23022',
            'namaMK'         => 'BACK-END PROGRAMMING',
            'sks'            => 4,
            'kelas'          => 'C',
            'dosenPengajar'  => '10812001 JANSON HENDRYLI, S. Kom. M.Kom.',
            'ruangDanWaktu'  => 'R0902 / RABU(13:30 s/d 15:10) R1007 / RABU(11:30 s/d 13:10)',
            'kodeMSteams'    => 'ew9tefy',
            'emailDosen'     => 'jansonh@fti.untar.ac.id'
        ]);
    }
}
