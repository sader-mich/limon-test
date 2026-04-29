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

        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('productor');
            $table->string('CURP')->nullable();
            $table->string('ine')->nullable();
            $table->string('inicio_huerto')->nullable();
            $table->string('certificado')->nullable();
            $table->string('correo')->nullable();
            $table->string('lada',3)->nullable();
            $table->string('telefono',7)->nullable();
            $table->string('identificador');
            $table->string('estatus');
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
