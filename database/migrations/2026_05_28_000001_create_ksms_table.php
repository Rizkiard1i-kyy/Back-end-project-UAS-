<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ksms', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim');
            $table->string('prodi');
            $table->string('semester');        
            $table->string('tahunAkademik');     
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ksms');
    }
};
