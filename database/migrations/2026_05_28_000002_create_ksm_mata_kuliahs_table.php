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
        Schema::create('ksm_mata_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ksm_id')->constrained('ksms')->onDelete('cascade');
            $table->integer('no');
            $table->string('kodeMatkul', 10);
            $table->string('namaMatkul');
            $table->integer('sks');
            $table->string('kelas', 5);
            $table->string('status', 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ksm_mata_kuliahs');
    }
};
