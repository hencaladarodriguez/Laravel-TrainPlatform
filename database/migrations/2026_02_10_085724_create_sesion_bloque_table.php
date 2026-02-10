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
        Schema::create('sesion_bloque', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_sesion_entrenamiento')
                ->constrained('sesion_entrenamiento')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('id_bloque_entrenamiento')
                ->constrained('bloque_entrenamiento')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->integer('orden');
            $table->integer('repeticiones')->default(1);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesion_bloque');
    }
};
