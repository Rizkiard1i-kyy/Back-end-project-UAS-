<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Pengguna::create([
            'nama'     => 'Admin',
            'email'    => 'admin@untar.ac.id',
            'nim'      => 'admin001',
            'password' => Hash::make('12345678'),
            'role'     => 'admin',
        ]);

        Pengguna::create([
            'nama'     => 'hartono',
            'email'    => 'hartono@gmail',
            'nim'      => '535250130',
            'password' => Hash::make('12345678'),
            'role'     => 'mahasiswa',
        ]);

        Pengguna::create([
            'nama'     => 'Jhon',
            'email'    => 'jhon@gmail',
            'nim'      => '535250133',
            'password' => Hash::make('12345678'),
            'role'     => 'mahasiswa',
        ]);

        Pengguna::create([
            'nama'     => 'joseph',
            'email'    => 'joseph@gmail',
            'nim'      => '535250135',
            'password' => Hash::make('12345678'),
            'role'     => 'mahasiswa',
        ]);

        Pengguna::create([
            'nama'     => 'rizki',
            'email'    => 'rizki@gmail',
            'nim'      => '535250127',
            'password' => Hash::make('12345678'),
            'role'     => 'mahasiswa',
        ]);

        Pengguna::create([
            'nama'     => 'christian',
            'email'    => 'Christian@gmail',
            'nim'      => '535250141',
            'password' => Hash::make('12345678'),
            'role'     => 'mahasiswa',
        ]);

        Pengguna::create([
            'nama'     => 'joshua',
            'email'    => 'joshua@gmail',
            'nim'      => '535250146',
            'password' => Hash::make('12345678'),
            'role'     => 'mahasiswa',
        ]);

        Pengguna::create([
            'nama'     => 'AGUS BUDI DHARMAWAN (S.Kom, M.T., M.Sc.)',
            'email'    => 'agus@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);

        
        Pengguna::create([
            'nama'     => 'BAGUS MULYAWAN (Dr., S.Kom., M.M.)',
            'email'    => 'bagus@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);

        
        Pengguna::create([
            'nama'     => 'CHAIRISNI LUBIS (Dra., M.Kom. )',
            'email'    => 'chatrisni@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);

        
        Pengguna::create([
            'nama'     => 'DARIUS ANDANA HARIS (S.KOM., M.T.I.)',
            'email'    => 'darius@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);

        Pengguna::create([
            'nama'     => 'DEDI TRISNAWARMAN (S.Si., M.Kom., Dr.)',
            'email'    => 'dedi@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);

        Pengguna::create([
            'nama'     => 'DESI ARISANDI (S.Kom., M.T.I.)',
            'email'    => 'desi@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);

        Pengguna::create([
            'nama'     => 'DYAH ERNY HERWINDIATI (Prof., Ir., M.Si, Dr.)',
            'email'    => 'dyah@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);

        Pengguna::create([
            'nama'     => 'IRVAN LEWENUSA (S.Kom., M.Kom.)',
            'email'    => 'irvan@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);

        Pengguna::create([
            'nama'     => 'JANSON HENDRYLI (S. Kom. M.Kom.)',
            'email'    => 'janson@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);

        Pengguna::create([
            'nama'     => 'JAP TJI BENG (Ir., MMSI., M.Psi., Ph.D., P.E., M.ASCE)',
            'email'    => 'jap@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);

        Pengguna::create([
            'nama'     => 'JEANNY PRAGANTHA (Ir., M.Eng)',
            'email'    => 'jenny@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);

        Pengguna::create([
            'nama'     => 'LELY HIRYANTO (ST., M.Sc.,Ph.D.)',
            'email'    => 'lely@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);
        
        Pengguna::create([
            'nama'     => 'LINA (Prof. S.T., M.Kom., Ph.D.)',
            'email'    => 'lina@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);
        
        Pengguna::create([
            'nama'     => 'MANATAP DOLOK LAURO (S.Kom., M.M.S.I.)',
            'email'    => 'manatap@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);
        
        Pengguna::create([
            'nama'     => 'NOVARIO JAYA PERDANA (S.Kom., M.T.)',
            'email'    => 'novario@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);
        
        Pengguna::create([
            'nama'     => 'TENY HANDHAYANI (S.Kom., M.Kom., Ph.D.)',
            'email'    => 'teny @gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);
        
        Pengguna::create([
            'nama'     => 'TONY (S.Kom., M.Kom., Ph. D.)',
            'email'    => 'tony@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);

        Pengguna::create([
            'nama'     => 'TRI SUTRISNO (S.Si., M.Sc.)',
            'email'    => 'tri@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);
        
        Pengguna::create([
            'nama'     => 'VINY CHRISTANTI MAWARDI (S.Kom., M.Kom.)',
            'email'    => 'viny@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);

        Pengguna::create([
            'nama'     => 'WASINO (S.Kom., M.Kom.,Dr.)',
            'email'    => 'wasino@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);
        $this->call([
            TagSeeder::class,
            MataKuliahSeeder::class,
            KalenderAkademikSeeder::class,
            KonsultasiSeeder::class,
            JadwalSeeder::class,
            RpsSeeder::class,
            SkpiSeeder::class,
            HistoriNilaiSeeder::class,
            NilaiHasilSeeder::class,
            UkmSeeder::class,
        ]);

        $this->command->info('Seeder selesai');
    }
}