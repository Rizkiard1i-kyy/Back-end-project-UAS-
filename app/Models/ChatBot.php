<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatBot extends Model
{
    protected $fillable = [
        'user_id',
        'role',    // 'user' | 'bot'
        'message',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pengguna()
    {
        return $this->belongsTo(\App\Models\Pengguna::class, 'user_id');
    }
}
