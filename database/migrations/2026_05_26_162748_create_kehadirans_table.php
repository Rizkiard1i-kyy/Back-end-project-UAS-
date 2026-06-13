<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kehadirans', function (Blueprint $table) {
            $table->id();
            $table->string('matkul')->constrained('mata_kuliahs');
            $table->string('semester');
            $table->foreignId('namaDosen')->constrained('users');
            $table->foreignId('nim')->constrained('users');
            $table->string('kelas');
            $table->integer('jumlahPertemuan');
            $table->integer('jumlahKehadiran');
            $table->decimal('persentase');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadirans');
    }
};