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
}
