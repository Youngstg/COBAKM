<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * TABEL PIVOT UNTUK ARTIKEL DAN TAG
     *
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('a_t_k_tag_a_t_k', function (Blueprint $table) {
            $table->foreignId('a_t_k_id');
            $table->foreign('a_t_k_id')->references('id')->on('a_t_k_s')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('tag_a_t_k_id');
            $table->foreign('tag_a_t_k_id')->references('id')->on('tag_a_t_k_s')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_t_k_tag_a_t_k');
    }
};
