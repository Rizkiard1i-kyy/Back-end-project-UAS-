<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $fillable = ['kodeMatkul', 
    'namaMatkul',
    'semester',
    'namaDosen',
    'nim',
    'kelas',
    'jumlahPertemuan',
    'jumlahKehadiran',
    'persentase'];

    public function mahasiswa() {
        return $this->belongsTo(Pengguna::class, 'nim', 'id');
    }

    public function dosen() {
        return $this->belongsTo(Pengguna::class, 'namaDosen', 'id');
    }
}
