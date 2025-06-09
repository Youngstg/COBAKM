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
        Schema::create('podcasts', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('kategori');
            $table->string('narasumber');
            $table->string('pewawancara');
            $table->string('link');
            $table->boolean('features_podcast')->default(false);
            $table->boolean('top_podcast')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcasts');
    }
};
