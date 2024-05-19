<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('historial_flujo_documentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_documento');
            $table->string('id_programa_anterior', 5)->nullable();
            $table->text('obs_anterior')->nullable();
            $table->timestamp('fecha_recepcion_anterior')->nullable();
            $table->timestamp('fecha_envio_anterior')->nullable();
            $table->timestamp('fecha_modificacion')->default(now());
            $table->timestamp('created_at')->default(now());
        });
    }

    public function down()
    {
        Schema::dropIfExists('historial_flujo_documentos');
    }
};
