<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skema_Pembayaran extends Model
{
    protected $table = 'skema__pembayarans';

    protected $fillable = [
        'namaSkema', 
        'jumlahCicilan', 
        'jumlahPembayaran', 
        'tanggalJatuhTempo'
    ];

}
