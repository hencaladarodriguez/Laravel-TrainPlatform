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
        Schema::create('plan_entrenamiento', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_ciclista')
                ->constrained('ciclista')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->string('nombre', 100);
            $table->string('descripcion')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('objetivo')->nullable();
            $table->boolean('activo')->default(true);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_entrenamiento');
    }
};
