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
        Schema::create('histori_nilais', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->constrained('users');
            $table->string('namaDosen')->constrained('users');
            $table->string('tahunAkademik');
            $table->string('namaMataKuliah')->constrained('mata_kuliahs');;
            $table->string('nilai');
            $table->decimal('bobot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histori_nilais');
    }
};
