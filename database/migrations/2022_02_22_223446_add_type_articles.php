<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dx_articulo', function (Blueprint $table) {
            $table->string('tipo')->after('resumen')->nullable();
            $table->string('archivo')->after('video')->nullable();
            $table->string('redireccion')->after('video')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dx_articulo', function (Blueprint $table) {
            $table->dropColumn(['tipo', 'archivo', 'redireccion']);
        });
    }
}
