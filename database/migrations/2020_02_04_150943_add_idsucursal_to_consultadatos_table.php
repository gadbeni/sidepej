<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdsucursalToConsultadatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultadatos', function (Blueprint $table) {
             $table->unsignedBigInteger('sucursal_id')->nullable();
             $table->foreign('sucursal_id')->references('id')->on('sucursals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultadatos', function (Blueprint $table) {
            //
        });
    }
}
