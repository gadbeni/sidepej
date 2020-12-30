<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultadatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultadatos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numeroResolucion', 955)->nullable();
            $table->string('fechaResolucion', 955)->nullable();
            $table->string('razonSocial', 955)->nullable();
            $table->string('provincia', 955)->nullable();
            $table->string('municipio', 955)->nullable();
            $table->string('localidad', 955)->nullable();
            $table->string('objeto', 955)->nullable();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultadatos');
    }
}
