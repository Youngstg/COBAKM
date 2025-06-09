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
        Schema::create('arp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sai')->nullable();
            $table->foreign('id_sai')->references('id')->on('sai')
                ->constrained('arp')->onDelete('cascade')->onUpdate('cascade');
            $table->string('judul_arp');
            $table->string('link_arp')->nullable();
            $table->date('tgl_arp');
            $table->string('publisher_arp');
            $table->string('slug_nav_arp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arp');
    }
};
