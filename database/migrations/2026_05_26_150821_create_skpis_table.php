<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skpis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('kegiatan');
            $table->string('jenis');
            $table->string('klasifikasi');
            $table->date('tgl_input');
            $table->string('bukti');
            $table->string('validasi')->default('Belum');  
            $table->integer('point')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skpis');
    }
};