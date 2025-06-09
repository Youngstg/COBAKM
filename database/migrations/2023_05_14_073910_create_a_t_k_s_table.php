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
        Schema::create('a_t_k_s', function (Blueprint $table) {
            $table->id();
            $table->string('judul_atk');
            $table->string('penulis_atk');
            $table->string('gambar_atk')->nullable();
            $table->string('kategori_atk')->nullable();
            $table->text('konten_atk');
            $table->string('slug_atk')->unique();
            $table->dateTime('published_at');
            $table->boolean('features_atk')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_t_k_s');
    }
};
