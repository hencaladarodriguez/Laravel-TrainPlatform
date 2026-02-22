<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bloque_entrenamiento', function (Blueprint $table) {
            $table->foreignId('id_ciclista')
                ->constrained('ciclista')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bloque_entrenamiento', function (Blueprint $table) {
            //
        });
    }
};
