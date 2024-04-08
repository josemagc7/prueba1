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
        Schema::create('tratamiento_user', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('tratamiento_id');
            // $table->foreign('tratamiento_id')->references('id')->on('tratamientos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tratamiento_user');
    }
};
