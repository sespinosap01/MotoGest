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
            $table->integer('kilometraje')->nullable();
            $table->date('fechaVencimientoSeguro')->nullable();
            $table->date('fechaVencimientoITV')->nullable();
            $table->date('fechaBateria')->nullable();
            $table->integer('kmAceiteMotor')->nullable();
            $table->integer('kmRuedaTrasera')->nullable();
            $table->integer('kmRuedaDelantera')->nullable();
            $table->integer('kmPastillaFrenoDelantero')->nullable();
            $table->integer('kmPastillaFrenoTrasero')->nullable();
            $table->integer('kmReglajeValvulas')->nullable();
            $table->integer('kmCadena')->nullable();
            $table->integer('kmRetenesHorquilla')->nullable();
            $table->integer('kmKitTransmision')->nullable();
            $table->integer('gastosGeneral')->nullable();
            
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
