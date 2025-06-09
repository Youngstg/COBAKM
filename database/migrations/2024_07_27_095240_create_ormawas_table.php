<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrmawasTable extends Migration
{
    public function up()
    {
        Schema::create('ormawas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('ketua');
            $table->string('website')->nullable();
            $table->text('details')->nullable();
            $table->string('dies_natalis')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('hmps')->default(false);
            $table->boolean('ukm')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ormawas');
    }
}
