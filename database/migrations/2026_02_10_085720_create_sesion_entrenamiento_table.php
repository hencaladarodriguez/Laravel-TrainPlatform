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
        Schema::create('sesion_entrenamiento', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_plan')
                ->constrained('plan_entrenamiento')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->date('fecha');
            $table->string('nombre')->nullable();
            $table->string('descripcion')->nullable();
            $table->boolean('completada')->default(false);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesion_entrenamiento');
    }
};
