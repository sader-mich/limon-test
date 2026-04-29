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
        Schema::create('municipio', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
        });

        Schema::create('localidades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('municipioid');
            $table->string('descripcion');

            $table->foreign('municipioid')
            ->references('id')
            ->on('municipio')
            ->onUpdate('cascade')
            ->onDelete('restrict');
        });

        Schema::create('producers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('documento_id');
            $table->string('municipio');
            $table->string('localidad');
            $table->string('huerto');
            $table->double('latitud');
            $table->double('longitud');
            $table->string('especie');
            $table->double('toneladas');
            $table->double('descuento');
            $table->string('urlqr');
            $table->string('urlcard');
            $table->date('fecha_alta');
            $table->string('siembra_id');
            $table->string('predio');
            $table->double('no_ha');
            $table->string('edad_siembra');
            $table->string('propia_renta');
            $table->string('vencimiento');
            $table->timestamps();

            $table->foreign('documento_id')
            ->references('id')
            ->on('documentos')
            ->onUpdate('cascade')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producers');
    }
};
