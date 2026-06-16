<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai_hasils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nim')->constrained('users');
            $table->foreignId('namaDosen')->constrained('users');
            $table->string('tahunAkademik');
            $table->integer('tugas');
            $table->integer('uts');
            $table->integer('uas');

            $table->string('namaMataKuliah')->constrained('mata_kuliahs');
            $table->string('status');
            $table->string('nilaiHuruf');
            $table->decimal('nilaiAngka');
            $table->decimal('bobotKualitas');
            $table->string('keterangan');

            $table->integer('sks');
            $table->integer('sksSemester');
            $table->decimal('ips');
            $table->integer('kreditDiambil');
            $table->integer('kreditPeroleh');
            $table->decimal('ipk');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_hasils');
    }
};
