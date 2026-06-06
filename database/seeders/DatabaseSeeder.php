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
            'nama'     => 'yanto',
            'email'    => 'yanto@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);

        
        Pengguna::create([
            'nama'     => 'dewi ',
            'email'    => 'dewi@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);

        
        Pengguna::create([
            'nama'     => 'ajeng',
            'email'    => 'ajeng@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);

        
        Pengguna::create([
            'nama'     => 'supriadi',
            'email'    => 'supriadi@gmail',
            'nim'      => '',
            'password' => Hash::make('12345678'),
            'role'     => 'dosen',
        ]);
        $this->command->info('Seeder selesai');
    }
}

