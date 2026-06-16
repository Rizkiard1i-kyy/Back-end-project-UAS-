<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_akademik');
            $table->string('matkul')->constrained('mata_kuliahs');
            $table->foreignId('dosenPengajar')->constrained('users');
            $table->string('kelas');
            $table->string('ruangDanWaktu');
            $table->string('kodeMSteams')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
