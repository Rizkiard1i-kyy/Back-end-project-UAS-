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
        Schema::create('surat_permohonans', function (Blueprint $table) {
        $table->increments('no');
        $table->string('nim');
        $table->timestamp('tanggal_pengajuan')->useCurrent();
        $table->string('jenis_surat');
        $table->string('bahasa');
        $table->string('status')->default('pending');
    });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_permohonans');
    }
};
