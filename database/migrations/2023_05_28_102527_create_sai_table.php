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
        Schema::create('sai', function (Blueprint $table) {
            $table->id();
            $table->string('judul_sai');
            $table->string('logo_sai');
            $table->string('sub_judul_sai');
            $table->string('desk_sub_judul_sai'); //deskripsi
            $table->string('slug_sub_sai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sai');
    }
};
