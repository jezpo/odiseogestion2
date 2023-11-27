<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('flujo_documentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_documento');
            $table->timestamp('fecha_recepcion');
            $table->string('id_programa', 5);
            $table->text('obs');
            $table->timestamps();

            $table->foreign('id_documento')->references('id')->on('documentos');
            $table->foreign('id_programa')->references('id_programa')->on('programas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('flujo_documentos');
    }
};
