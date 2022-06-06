<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservajusticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservajusticias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('provincia_id')->unsigned();
            $table->unsignedBigInteger('municipio_id')->unsigned();
            $table->unsignedBigInteger('estadotramite_id')->unsigned();
            $table->unsignedBigInteger('sucursal_id')->unsigned();
            $table->string('nombreSolicitante', 999)->nullable();
            $table->string('nombre', 999)->nullable();
            $table->string('localidad', 999)->nullable();
            $table->string('numeroRecibo', 999)->nullable();
            $table->decimal('costoReserva', 11, 2);
            $table->date('fechainicio');
            $table->date('fechafin');
            //ip del usuario que realiza el registro
            $table->string('registro_clientIP', 15);
            //ip del usuario que actualiza el registro
            $table->string('registro_clientIP_update', 15);
            $table->boolean('condicionPersoneria')->default(1);
            $table->boolean('condicion')->default(1);
            $table->timestamps();

            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->foreign('estadotramite_id')->references('id')->on('estadotramites');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');

            $table->smallInteger('status')->default(1);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservajusticias');
    }
}
