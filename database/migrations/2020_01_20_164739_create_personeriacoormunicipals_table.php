<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersoneriacoormunicipalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personeriacoormunicipals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('reservacoormunicipal_id')->unsigned();
            $table->unsignedBigInteger('expedicion_id')->unsigned();
            $table->unsignedBigInteger('objeto_id')->unsigned();
            $table->unsignedBigInteger('ambitoaplicacion_id')->unsigned();
            $table->unsignedBigInteger('tipoorganizacion_id')->unsigned();
            $table->date('fechaIngreso');
            $table->string('hojaRuta', 999)->nullable();
            $table->string('representante', 999)->nullable();
            $table->string('CI', 999)->nullable();
            $table->string('numeroCertificado', 999)->nullable();
            $table->string('numeroResolucion', 999)->nullable();
            $table->date('fechaResolucion');
            $table->string('caratulaNotarial', 999)->nullable();
            $table->string('caratulaExpediente', 999)->nullable();
            $table->string('folderExpediente', 999)->nullable();
            $table->string('numeroTestimonio', 999)->nullable();
            $table->date('fechaEntrega');
            $table->date('fechaConclusiontramite');

            $table->string('documentoMunicipal', 999)->nullable();
            $table->string('numeroDocumento')->nullable();
            $table->string('fechaNumerodocumento', 10)->nullable();
            //ip del usuario que realiza el registro
            $table->string('registro_clientIP', 15);
            //ip del usuario que actualiza el registro
            $table->string('registro_clientIP_update', 15);
            $table->string('archivo', 999)->nullable();
            $table->string('file_name')->nullable();

            $table->boolean('condicion')->default(1);
            $table->timestamps();

            $table->foreign('reservacoormunicipal_id')->references('id')->on('reservacoormunicipals');
            $table->foreign('expedicion_id')->references('id')->on('expedicions');
            $table->foreign('objeto_id')->references('id')->on('objetos');
            $table->foreign('ambitoaplicacion_id')->references('id')->on('ambitoaplicacions');
            $table->foreign('tipoorganizacion_id')->references('id')->on('tipoorganizacions');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personeriacoormunicipals');
    }
}
