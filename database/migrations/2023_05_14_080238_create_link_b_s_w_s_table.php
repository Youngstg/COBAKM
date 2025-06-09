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
        Schema::create('link_b_s_w_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bsw_id')->nullable();
            $table->foreign('bsw_id')->references('id')->on('b_s_w_s')
                ->constrained('link_b_s_w_s')->onDelete('cascade')->onUpdate('cascade');
            $table->string('judul_link');
            $table->string('link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_b_s_w_s');
    }
};
