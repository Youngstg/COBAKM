<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('k_m_activities', function (Blueprint $table) {
            $table->id();
            $table->string('title_kmac');
            $table->string('ketuplak_kmac')->nullable();
            $table->string('gambar_kmac')->nullable();
            $table->string('slug_kmac')->unique();
            $table->text('konten_kmac');
            $table->text('deskripsi_kmac');
            $table->dateTime('tgl_pelaksanaan');
            $table->boolean('features_kmac')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('k_m_activities');
    }
};
