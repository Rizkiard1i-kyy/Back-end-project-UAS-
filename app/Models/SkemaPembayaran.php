<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkemaPembayaran extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_skema',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(\App\Models\Pengguna::class, 'user_id');
    }
}
