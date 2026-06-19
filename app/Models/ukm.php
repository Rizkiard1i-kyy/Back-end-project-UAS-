<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ukm extends Model
{
    protected $fillable = [
        'nama',
        'ketua',
        'anggota',
        'detail',
    ];

    public function mahasiswa() {
        return $this->belongsTo(Pengguna::class, 'ketua', 'id');
    }

    public function dosen() {
        return $this->belongsTo(Pengguna::class, 'namaDosen', 'id');
    }
}
