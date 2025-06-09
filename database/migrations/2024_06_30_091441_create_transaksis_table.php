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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->string('no_wa');
            $table->string('email');
            $table->double('total_harga');
            $table->enum('status_barang', ['menunggu_pembayaran', 'diproses', 'siap_diambil', 'diserahkan', 'dibatalkan']);
            $table->string('nama_penerima')->nullable();
            $table->string('no_wa_penerima')->nullable();
            $table->string('bukti_penerimaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
