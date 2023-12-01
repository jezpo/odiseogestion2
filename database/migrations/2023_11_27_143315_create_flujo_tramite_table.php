<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('flujo_tramite', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tipo_tramite');
            $table->string('id_programa', 5);
            $table->smallInteger('orden');
            $table->time('tiempo');
            $table->char('estado', 1);


        });
    }

    public function down()
    {
        Schema::dropIfExists('flujo_tramite');
    }
};
