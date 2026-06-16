<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KalenderAkademik;

class KalenderAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KalenderAkademik::create([
            'tanggalMulai'     => '2026-10-05',
            'tanggalSelesai'    => '2026-10-09',
            'namaKegiatan'      => 'Ujian Tengah Semester (UTS) Semester Ganjil 2026/2027',
            'tahunAkademik'     => '2026 Ganjil',
        ]);

        KalenderAkademik::create([
            'tanggalMulai'     => '2026-11-30',
            'tanggalSelesai'    => '2026-12-11',
            'namaKegiatan'      => 'Ujian Akhir Semester (UAS) Semester Ganjil 2026/2027',
            'tahunAkademik'     => '2026 Ganjil',
        ]);

        KalenderAkademik::create([
            'tanggalMulai'     => '2026-04-20',
            'tanggalSelesai'    => '2026-04-24',
            'namaKegiatan'      => 'Ujian Tengah Semester (UTS) Semester Genap 2025/2026',
            'tahunAkademik'     => '2025 Genap',
        ]);

        KalenderAkademik::create([
            'tanggalMulai'     => '2026-06-15',
            'tanggalSelesai'    => '2026-06-26',
            'namaKegiatan'      => 'Ujian Akhir Semester (UAS) Semester Genap 2025/2026',
            'tahunAkademik'     => '2025 Genap',
        ]);

        KalenderAkademik::create([
            'tanggalMulai'     => '2025-10-06',
            'tanggalSelesai'    => '2025-10-10',
            'namaKegiatan'      => 'Ujian Tengah Semester (UTS) Semester Ganjil 2025/2026',
            'tahunAkademik'     => '2025 Ganjil',
        ]);

        KalenderAkademik::create([
            'tanggalMulai'     => '2025-12-01',
            'tanggalSelesai'    => '2025-12-12',
            'namaKegiatan'      => 'Ujian Akhir Semester (UAS) Semester Ganjil 2025/2026',
            'tahunAkademik'     => '2025 Ganjil',
        ]);
    }
}