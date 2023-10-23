<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->bigIncrements('idMantenimiento');
            $table->unsignedBigInteger('idMoto')->unique();
            $table->foreign('idMoto')->references('idMoto')->on('motos')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('kilometraje');
            $table->date('fechaVencimientoSeguro');
            $table->date('fechaVencimientoITV');
            $table->date('fechaBateria');
            $table->integer('kmAceiteMotor');
            $table->integer('kmRuedaTrasera');
            $table->integer('kmRuedaDelantera');
            $table->integer('kmPastillaFrenoDelantero');
            $table->integer('kmPastillaFrenoTrasero');
            $table->integer('kmReglajeValvulas');
            $table->integer('kmCadena');
            $table->integer('kmRetenesHorquilla');
            $table->integer('kmKitTransmision');
            $table->integer('gastosGeneral');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mantenimientos', function (Blueprint $table) {
            //
        });
    }
};
