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
        Schema::create('alis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ali');
            $table->string('jabatan_ali')->nullable();
            $table->string('kp_ali')->nullable();
            $table->string('pkj_ali')->nullable();
            $table->string('thn_ali')->nullable();
            $table->string('prodi_ali');
            $table->string('foto_ali')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alis');
    }
};
