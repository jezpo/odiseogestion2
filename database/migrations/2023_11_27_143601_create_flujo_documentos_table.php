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
            $table->dateTime('fecha_recepcion')->nullable();
            $table->dateTime('fecha_envio');
            $table->string('id_programa', 5);
            $table->text('obs');
            $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('flujo_documentos');
    }
};
