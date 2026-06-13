<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Mahasiswa TI Angkatan 2023',
            'Mahasiswa TI Angkatan 2024',
            'Mahasiswa TI Angkatan 2025',
            'Mahasiswa TI Angkatan 2026',
            'Mahasiswa SI Angkatan 2023',
            'Mahasiswa SI Angkatan 2024',
            'Mahasiswa SI Angkatan 2025',
            'Mahasiswa SI Angkatan 2026',
            'Seluruh Mahasiswa TI',
            'Seluruh Mahasiswa SI',
            'Pengumuman Libur',
            'Pengumuman Kegiatan',
            'Pengumuman Akademik',
            'Pengumuman Non-Akademik',
            'Pengumuman Penting',
            'Pengumuman Wisuda',
            'Pengumuman Beasiswa'
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag
            ]);
        }
    }
}