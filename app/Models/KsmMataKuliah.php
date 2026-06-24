<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KsmMataKuliah extends Model
{
    protected $fillable = [
        'ksm_id',
        'no',
        'kodeMatkul',
        'sks',
        'kelas',
        'status',
    ];

    public function Mahasiswa()
    {
        return $this->belongsTo(User::class, 'nim', 'id');
    }

    public function ksm()
    {
        return $this->belongsTo(Ksm::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(mataKuliah::class, 'kodeMatkul');
    }
}
