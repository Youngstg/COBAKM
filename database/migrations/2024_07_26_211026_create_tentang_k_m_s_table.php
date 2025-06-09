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
        Schema::create('tentang_k_m_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('logo_id');
            $table->text('deskripsi');
            $table->text('visi');
            $table->text('misi');
            $table->string('presma');
            $table->string('prodi_presma');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tentang_k_m_s');
    }
};
