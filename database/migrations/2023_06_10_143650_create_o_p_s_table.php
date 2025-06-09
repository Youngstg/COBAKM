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
        Schema::create('o_p_s', function (Blueprint $table) {
            $table->id();
            $table->string('nama_op');
            $table->unsignedBigInteger('kategori_op')->nullable()->default(0);
            $table->text('catatan_op')->nullable();
            $table->string('gambar_op')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('o_p_s');
    }
};
