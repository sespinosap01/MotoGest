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
        Schema::create('motos', function (Blueprint $table) {
            $table->bigIncrements('idMoto');
            $table->unsignedBigInteger('idUsuario');
            $table->foreign('idUsuario')->references('idUsuario')->on('users');
            $table->string('marca');
            $table->string('modelo');
            $table->integer('potencia');
            $table->date('fechaFabricacion');
            $table->integer('kilometraje');
            $table->string('imagen');
            $table->string('matricula')->unique();
            $table->string('numeroBastidor')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('motos', function (Blueprint $table) {
            //
        });
    }
};
