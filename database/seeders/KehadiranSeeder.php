<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kehadiran;
use App\Models\Pengguna;
use App\Models\MataKuliah;

class KehadiranSeeder extends Seeder
{
    public function run(): void
    {
        $dosen = Pengguna::where('role', 'dosen')->get();

        $mahasiswa = Pengguna::where('role', 'mahasiswa')->get();

        $mataKuliah = MataKuliah::get();

        $dataSeederKehadiran = [
            [
                'matkul' => $mataKuliah[0]->id,
                'tahunAkademik'  => '2025 Genap',
                'namaDosen'      => $dosen[0]->id,
                'nim'            => $mahasiswa[0]->id,
                'kelas'          => 'C',
                'jumlahPertemuan'=> 15,
                'jumlahKehadiran'=> 14,
            ],
            [
                'matkul' => $mataKuliah[1]->id,
                'tahunAkademik'  => '2025 Genap',
                'namaDosen'      => $dosen[1]->id,
                'nim'            => $mahasiswa[0]->id,
                'kelas'          => 'C',
                'jumlahPertemuan'=> 15,
                'jumlahKehadiran'=> 15,
            ],
            [
                'matkul' => $mataKuliah[2]->id,
                'tahunAkademik'  => '2025 Genap',
                'namaDosen'      => $dosen[2]->id,
                'nim'            => $mahasiswa[0]->id,
                'kelas'          => 'C',
                'jumlahPertemuan'=> 15,
                'jumlahKehadiran'=> 13,
            ],
            [
                'matkul' => $mataKuliah[6]->id,
                'tahunAkademik'  => '2025 Ganjil',
                'namaDosen'      => $dosen[3]->id,
                'nim'            => $mahasiswa[0]->id,
                'kelas'          => 'C',
                'jumlahPertemuan'=> 16,
                'jumlahKehadiran'=> 16,
            ],
            [
                'matkul' => $mataKuliah[7]->id,
                'tahunAkademik'  => '2025 Ganjil',
                'namaDosen'      => $dosen[4]->id,
                'nim'            => $mahasiswa[0]->id,
                'kelas'          => 'C',
                'jumlahPertemuan'=> 16,
                'jumlahKehadiran'=> 16,
            ],
            [
                'matkul' => $mataKuliah[0]->id,
                'tahunAkademik'  => '2025 Genap',
                'namaDosen'      => $dosen[0]->id,
                'nim'            => $mahasiswa[1]->id,
                'kelas'          => 'C',
                'jumlahPertemuan'=> 15,
                'jumlahKehadiran'=> 15,
            ],
            [
                'matkul' => $mataKuliah[1]->id,
                'tahunAkademik'  => '2025 Genap',
                'namaDosen'      => $dosen[1]->id,
                'nim'            => $mahasiswa[1]->id,
                'kelas'          => 'C',
                'jumlahPertemuan'=> 15,
                'jumlahKehadiran'=> 15,
            ],
            [
                'matkul' => $mataKuliah[2]->id,
                'tahunAkademik'  => '2025 Genap',
                'namaDosen'      => $dosen[2]->id,
                'nim'            => $mahasiswa[1]->id,
                'kelas'          => 'C',
                'jumlahPertemuan'=> 15,
                'jumlahKehadiran'=> 15,
            ],
            [
                'matkul' => $mataKuliah[6]->id,
                'tahunAkademik'  => '2025 Ganjil',
                'namaDosen'      => $dosen[3]->id,
                'nim'            => $mahasiswa[1]->id,
                'kelas'          => 'C',
                'jumlahPertemuan'=> 16,
                'jumlahKehadiran'=> 16,
            ],
            [
                'matkul' => $mataKuliah[7]->id,
                'tahunAkademik'  => '2025 Ganjil',
                'namaDosen'      => $dosen[4]->id,
                'nim'            => $mahasiswa[1]->id,
                'kelas'          => 'C',
                'jumlahPertemuan'=> 16,
                'jumlahKehadiran'=> 14,
            ],
            [
                'matkul' => $mataKuliah[0]->id,
                'tahunAkademik'  => '2025 Genap',
                'namaDosen'      => $dosen[0]->id,
                'nim'            => $mahasiswa[2]->id,
                'kelas'          => 'C',
                'jumlahPertemuan'=> 15,
                'jumlahKehadiran'=> 13,
            ],
            [
                'matkul' => $mataKuliah[1]->id,
                'tahunAkademik'  => '2025 Genap',
                'namaDosen'      => $dosen[1]->id,
                'nim'            => $mahasiswa[2]->id,
                'kelas'          => 'C',
                'jumlahPertemuan'=> 15,
                'jumlahKehadiran'=> 14,
            ],
            [
                'matkul' => $mataKuliah[2]->id,
                'tahunAkademik'  => '2025 Genap',
                'namaDosen'      => $dosen[2]->id,
                'nim'            => $mahasiswa[2]->id,
                'kelas'          => 'C',
                'jumlahPertemuan'=> 15,
                'jumlahKehadiran'=> 15,
            ],
            [
                'matkul' => $mataKuliah[6]->id,
                'tahunAkademik'  => '2025 Ganjil',
                'namaDosen'      => $dosen[3]->id,
                'nim'            => $mahasiswa[2]->id,
                'kelas'          => 'C',
                'jumlahPertemuan'=> 16,
                'jumlahKehadiran'=> 15,
            ],
            [
                'matkul' => $mataKuliah[7]->id,
                'tahunAkademik'  => '2025 Ganjil',
                'namaDosen'      => $dosen[4]->id,
                'nim'            => $mahasiswa[2]->id,
                'kelas'          => 'C',
                'jumlahPertemuan'=> 16,
                'jumlahKehadiran'=> 16,
            ],
        ];

        foreach ($dataSeederKehadiran as $data) {
            $persen = $data['jumlahKehadiran'] / $data['jumlahPertemuan'] * 100;
            $data['persentase'] = $persen;

            Kehadiran::create($data);
        }
    }
}