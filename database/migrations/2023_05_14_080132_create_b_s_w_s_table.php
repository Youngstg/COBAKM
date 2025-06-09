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
        Schema::create('b_s_w_s', function (Blueprint $table) {
            $table->id();
            $table->string('judul_bsw')->nullable();
            $table->string('slug_bsw')->unique();
            $table->string('gambar_bsw')->nullable();
            $table->text('konten_bsw')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b_s_w_s');
    }
};
