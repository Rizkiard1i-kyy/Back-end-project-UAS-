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

        $this->command->info('Seeder selesai');
    }
}