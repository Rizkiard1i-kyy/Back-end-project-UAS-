<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ksm extends Model
{
    protected $fillable = [
        'nama',
        'nim',
        'prodi',
        'semester',
        'tahunAkademik',
    ];

    public function mataKuliahs()
    {
        return $this->hasMany(KsmMataKuliah::class);
    }

    public function getTotalSksAttribute(): int
    {
        return $this->mataKuliahs->sum('sks');
    }
}
