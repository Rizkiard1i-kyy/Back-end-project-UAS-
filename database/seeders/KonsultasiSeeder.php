<?php

namespace Database\Seeders;

use App\Models\Konsultasi;
use App\Models\Pengguna;
use Illuminate\Database\Seeder;

class KonsultasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $dosen = Pengguna::where('role', 'dosen')->get();

    if ($dosen->count() < 3) {
        return;
    }

Konsultasi::create([
    'nim' => '535250130',
    'nama_mahasiswa' => 'hartono',
    'nama_dosen' => $dosen[0]->nama,
    'dosen_id' => $dosen[0]->id,
    'tanggal' => now()->addDays(1)->toDateString(),
    'jam' => '09:00 - 12:00',
    'topik' => 'Konsultasi tentang ngambil mata kuliah semester depan.',
    'status' => 'menunggu',
    'catatan' => null,
]);

Konsultasi::create([
    'nim' => '535250133',
    'nama_mahasiswa' => 'Jhon',
    'nama_dosen' => $dosen[0]->nama,
    'dosen_id' => $dosen[0]->id,
    'tanggal' => now()->addDays(2)->toDateString(),
    'jam' => '10:40 - 13:30',
    'topik' => 'Konsultasi skripsi.',
    'status' => 'disetujui',
    'catatan' => 'proposal jgn lupa',
]);

Konsultasi::create([
    'nim' => '535250135',
    'nama_mahasiswa' => 'joseph',
    'nama_dosen' => $dosen[0]->nama,
    'dosen_id' => $dosen[0]->id,
    'tanggal' => now()->addDays(3)->toDateString(),
    'jam' => '13:00 - 14:00',
    'topik' => 'Konsultasi tugas akhir.',
    'status' => 'ditolak',
    'catatan' => 'saya full di jam segitu',
]);

Konsultasi::create([
    'nim' => '535250127',
    'nama_mahasiswa' => 'rizki',
    'nama_dosen' => $dosen[1]->nama,
    'dosen_id' => $dosen[1]->id,
    'tanggal' => now()->addDays(4)->toDateString(),
    'jam' => '08:00 - 09:00',
    'topik' => 'Konsultasi KRS semester depan.',
    'status' => 'menunggu',
    'catatan' => null,
]);

Konsultasi::create([
    'nim' => '535250141',
    'nama_mahasiswa' => 'christian',
    'nama_dosen' => $dosen[1]->nama,
    'dosen_id' => $dosen[1]->id,
    'tanggal' => now()->addDays(5)->toDateString(),
    'jam' => '09:30 - 10:30',
    'topik' => 'Konsultasi magang.',
    'status' => 'disetujui',
    'catatan' => 'siapkan CV dan transkrip nilai',
]);

Konsultasi::create([
    'nim' => '535250146',
    'nama_mahasiswa' => 'joshua',
    'nama_dosen' => $dosen[1]->nama,
    'dosen_id' => $dosen[1]->id,
    'tanggal' => now()->addDays(6)->toDateString(),
    'jam' => '14:00 - 15:00',
    'topik' => 'Konsultasi revisi proposal.',
    'status' => 'ditolak',
    'catatan' => 'jadwal bentrok dengan rapat',
]);

Konsultasi::create([
    'nim' => '535250130',
    'nama_mahasiswa' => 'hartono',
    'nama_dosen' => $dosen[2]->nama,
    'dosen_id' => $dosen[2]->id,
    'tanggal' => now()->addDays(7)->toDateString(),
    'jam' => '10:00 - 11:00',
    'topik' => 'Konsultasi mata kuliah pilihan.',
    'status' => 'menunggu',
    'catatan' => null,
]);

Konsultasi::create([
    'nim' => '535250133',
    'nama_mahasiswa' => 'Jhon',
    'nama_dosen' => $dosen[2]->nama,
    'dosen_id' => $dosen[2]->id,
    'tanggal' => now()->addDays(8)->toDateString(),
    'jam' => '11:00 - 12:00',
    'topik' => 'Konsultasi skripsi bab 3.',
    'status' => 'disetujui',
    'catatan' => 'revisi codingan penelitian',
]);

Konsultasi::create([
    'nim' => '535250135',
    'nama_mahasiswa' => 'joseph',
    'nama_dosen' => $dosen[2]->nama,
    'dosen_id' => $dosen[2]->id,
    'tanggal' => now()->addDays(9)->toDateString(),
    'jam' => '15:00 - 16:00',
    'topik' => 'Konsultasi tugas akhir.',
    'status' => 'ditolak',
    'catatan' => 'saya sibuk silakan ajukan kembali minggu depan',
]);

Konsultasi::create([
    'nim' => '535250127',
    'nama_mahasiswa' => 'rizki',
    'nama_dosen' => $dosen[3]->nama,
    'dosen_id' => $dosen[3]->id,
    'tanggal' => now()->addDays(10)->toDateString(),
    'jam' => '08:30 - 09:30',
    'topik' => 'Konsultasi persiapan magang.',
    'status' => 'menunggu',
    'catatan' => null,
]);

Konsultasi::create([
    'nim' => '535250141',
    'nama_mahasiswa' => 'christian',
    'nama_dosen' => $dosen[3]->nama,
    'dosen_id' => $dosen[3]->id,
    'tanggal' => now()->addDays(11)->toDateString(),
    'jam' => '13:00 - 14:00',
    'topik' => 'Konsultasi seminar proposal.',
    'status' => 'disetujui',
    'catatan' => 'siapkan slide presentasi',
]);

Konsultasi::create([
    'nim' => '535250146',
    'nama_mahasiswa' => 'joshua',
    'nama_dosen' => $dosen[3]->nama,
    'dosen_id' => $dosen[3]->id,
    'tanggal' => now()->addDays(12)->toDateString(),
    'jam' => '16:00 - 17:00',
    'topik' => 'Konsultasi revisi tugas akhir.',
    'status' => 'ditolak',
    'catatan' => 'saya lagi cuti kemana aja kamu kemarin?',
]);
    }
}