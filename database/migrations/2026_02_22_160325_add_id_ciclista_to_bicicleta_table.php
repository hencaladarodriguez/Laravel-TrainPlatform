<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdCiclistaToBicicletaTable extends Migration
{
    public function up()
    {
        Schema::table('bicicleta', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ciclista');

            $table->foreign('id_ciclista')
                  ->references('id')
                  ->on('ciclista')
                  ->cascadeonDelete();
        });
    }

    public function down()
    {
        Schema::table('bicicleta', function (Blueprint $table) {
            $table->dropForeign(['id_ciclista']);
            $table->dropColumn('id_ciclista');
        });
    }
}