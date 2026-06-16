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
        'dosen_id',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
    public function dosen()
    {
        return $this->belongsTo(Pengguna::class, 'dosen_id');
    }
}