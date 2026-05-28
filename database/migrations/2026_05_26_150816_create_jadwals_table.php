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
            $table->string('kodeMK');
            $table->string('namaMK');
            $table->integer('sks');
            $table->string('kelas');
            $table->string('dosenPengajar');
            $table->string('ruangDanWaktu');
            $table->string('kodeMSteams')->nullable();
            $table->string('emailDosen');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
