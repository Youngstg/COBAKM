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
        Schema::create('k_b_t', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kbt');
            $table->string('nama_presma');
            $table->string('prodi_presma');
            $table->string('logo_kbt')->nullable();
            $table->string('foto_kbt')->nullable();
            $table->string('tahun_kbt');
            $table->text('desk_kbt')->nullable();
            $table->boolean('status_kbt')->default(false);
            $table->string('slug_kbt')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('k_b_t');
    }
};
