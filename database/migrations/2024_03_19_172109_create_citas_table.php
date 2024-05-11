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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();

            //tratamiento
            $table->unsignedInteger('tratamiento_id');
            //peluquero
            $table->unsignedInteger('peluquero_id');
            //cliente
            $table->unsignedInteger('cliente_id');

            $table->string('fecha_cita');
            $table->string('hora_cita');
            $table->string('descripcion')->nullable();
            $table->boolean('asistencia')->default(0);
            $table->string('tratamiento');
            $table->string('precio');
            $table->string('tiempo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
