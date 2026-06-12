<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class historiNilai extends Model
{
    protected $fillable = [
        'nim',
        'tahunAkademik',
        'kode',
        'mataKuliah',
        'sks',
        'nilai',
        'bobot',
    ];

    public function mahasiswa() {
        return $this->belongsTo(Pengguna::class, 'nim', 'id');
    }

    public function dosen() {
        return $this->belongsTo(Pengguna::class, 'namaDosen', 'id');
    }
}
