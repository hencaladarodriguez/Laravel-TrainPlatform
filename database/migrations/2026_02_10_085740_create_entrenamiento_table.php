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
        Schema::create('entrenamiento', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_ciclista')
                ->constrained('ciclista')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('id_bicicleta')
                ->constrained('bicicleta')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('id_sesion')
                ->nullable()
                ->constrained('sesion_entrenamiento')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->dateTime('fecha');
            $table->time('duracion');
            $table->decimal('kilometros', 6, 2);
            $table->string('recorrido', 150);

            $table->integer('pulso_medio')->nullable();
            $table->integer('pulso_max')->nullable();
            $table->integer('potencia_media')->nullable();
            $table->integer('potencia_normalizada');

            $table->decimal('velocidad_media', 5, 2);
            $table->decimal('puntos_estres_tss', 6, 2)->nullable();
            $table->decimal('factor_intensidad_if', 4, 3)->nullable();

            $table->integer('ascenso_metros')->nullable();
            $table->string('comentario')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrenamiento');
    }
};
