<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ukm extends Model
{
    protected $fillable = [
        'nama',
        'nim',
        'anggota',
        'detail',
    ];

    public function mahasiswa() {
        return $this->belongsTo(Pengguna::class, 'nim', 'id');
    }
}
