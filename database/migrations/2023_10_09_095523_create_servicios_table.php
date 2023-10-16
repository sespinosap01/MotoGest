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
        Schema::create('servicios', function (Blueprint $table) {
            $table->bigIncrements('idServicio');
            $table->unsignedBigInteger('idMoto');
            $table->foreign('idMoto')->references('idMoto')->on('motos')->onDelete('cascade')->onUpdate('cascade');
            $table->string('tipoServicio');
            $table->string('descripcion');
            $table->date('fechaSolicitada');
            $table->date('fechaInicioServicio')->nullable();
            $table->date('fechaFinServicio')->nullable();
            $table->date('horaServicio');
            $table->string('estadoServicio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servicios', function (Blueprint $table) {
            //
        });
    }
};
