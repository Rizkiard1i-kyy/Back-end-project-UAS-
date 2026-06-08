<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'nama_dosen',
        'tanggal',
        'jam',
        'topik',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}