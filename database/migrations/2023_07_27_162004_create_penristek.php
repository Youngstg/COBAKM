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
        Schema::create('penristek', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->string('tgl_up')->nullable();
            $table->string('slug')->unique();
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('link_penristek')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penristek');
    }
};
