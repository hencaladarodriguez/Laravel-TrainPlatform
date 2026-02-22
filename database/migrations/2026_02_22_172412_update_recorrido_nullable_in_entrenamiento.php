<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRecorridoNullableInEntrenamiento extends Migration
{
    public function up()
    {
        Schema::table('entrenamiento', function (Blueprint $table) {
            $table->string('recorrido', 150)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('entrenamiento', function (Blueprint $table) {
            $table->string('recorrido', 150)->nullable(false)->change();
        });
    }
}