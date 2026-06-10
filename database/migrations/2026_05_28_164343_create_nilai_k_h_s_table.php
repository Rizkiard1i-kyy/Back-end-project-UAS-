<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai_k_h_s', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('tahunAkademik');
            $table->integer('tugas');
            $table->integer('uts');
            $table->integer('uas');

            $table->string('kodeMK');
            $table->string('namaMataKuliah');
            $table->string('status');
            $table->integer('sks');
            $table->string('nilaiHuruf');
            $table->integer('nilaiAngka');
            $table->integer('bobotKualitas');
            $table->string('keterangan');

            $table->integer('jumlahSKS');
            $table->integer('ips');
            $table->integer('kreditDiambil');
            $table->integer('kreditPeroleh');
            $table->integer('ipk');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_k_h_s');
    }
};
