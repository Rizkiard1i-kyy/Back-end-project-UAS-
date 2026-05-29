<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KsmMataKuliah extends Model
{
    protected $fillable = [
        'ksm_id',
        'no',
        'kodeMatkul',
        'namaMatkul',
        'sks',
        'kelas',
        'status',
    ];

    public function ksm()
    {
        return $this->belongsTo(Ksm::class);
    }
}
