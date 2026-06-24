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
        Schema::create('tagihan_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('tahun_akademik');
            $table->string('jenis');
            $table->string('no_virtual_account');
            $table->date('tgl_batas_bayar');
            $table->date('tgl_mulai_bayar')->nullable();
            $table->decimal('jumlah_tagihan', 15, 2);
            $table->text('rincian')->nullable();
            $table->string('bank')->nullable();
            $table->date('tgl_pembayaran')->nullable();
            $table->decimal('nominal_bayar', 15, 2)->nullable();
            $table->enum('status', ['BELUM LUNAS', 'LUNAS'])->default('BELUM LUNAS');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_pembayarans');
    }
};
