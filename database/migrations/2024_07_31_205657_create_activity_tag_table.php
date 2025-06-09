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
        Schema::create('activity_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained('k_m_activities')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tag_a_t_k_s')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_tag');
    }
};
