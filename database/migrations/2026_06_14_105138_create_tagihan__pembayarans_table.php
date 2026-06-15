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
        Schema::create('tagihan__pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('tahun_akademik');
            $table->string('jenis');
            $table->string('no_virtual_account')->nullable();
            $table->date('tgl_batas_bayar')->nullable();
            $table->bigInteger('jumlah_tagihan')->default(0);
            $table->string('rincian')->nullable();
            $table->string('bank')->nullable();
            $table->date('tgl_pembayaran')->nullable();
            $table->bigInteger('nominal_bayar')->default(0);
            $table->string('status')->default('BELUM LUNAS');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan__pembayarans');
    }
};
