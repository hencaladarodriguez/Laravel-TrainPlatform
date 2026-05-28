<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ciclista', function (Blueprint $table) {
            $table->string('password', 255)->change();
        });
    }

    public function down()
    {
        Schema::table('ciclista', function (Blueprint $table) {
            $table->string('password', 50)->change();
        });
    }
};
