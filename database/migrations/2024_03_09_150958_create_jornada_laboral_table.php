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
        Schema::create('jornada_laborals', function (Blueprint $table) {
            $table->id();

            $table->unsignedSmallInteger('dia');

            $table->boolean('activo');

            $table->time('tm_inicio')->nullable();
            $table->time('tm_fin')->nullable();
            $table->time('tt_inicio')->nullable();
            $table->time('tt_fin')->nullable();

            $table->unsignedInteger('id_peluquero');
            // $table->foreign('id_peluquero')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jornada_laborals');
    }
};
