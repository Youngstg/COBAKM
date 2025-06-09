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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->double('total_harga');
            $table->foreignUuid('transaksi_id')->constrained();
            $table->enum('metode_pembayaran', ['qris', 'other']);
            $table->enum('status_pembayaran', ['belum_dibayar', 'dibayar', 'kadaluarsa']);
            $table->string('redirect_url');
            $table->string('token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
