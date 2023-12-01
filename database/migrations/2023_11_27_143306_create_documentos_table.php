<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('cite');
            $table->text('descripcion');
            $table->string('estado');
            $table->string('hash', 32);
            $table->integer('id_tipo_documento');
            $table->binary('documento');
            $table->string('id_programa', 5);
            $table->timestamps();

 
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos');
    }
};
