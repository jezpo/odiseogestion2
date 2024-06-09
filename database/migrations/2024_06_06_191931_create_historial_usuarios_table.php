<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('historial_usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('accion');
            $table->unsignedBigInteger('documento_id')->nullable();
            $table->unsignedBigInteger('flujo_tramite_id')->nullable();
            $table->unsignedBigInteger('flujo_documento_id')->nullable();
            $table->unsignedBigInteger('tramite_id')->nullable();
            $table->unsignedBigInteger('programa_id')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('documento_id')->references('id')->on('documentos')->onDelete('cascade');
            $table->foreign('flujo_tramite_id')->references('id')->on('flujo_tramite')->onDelete('cascade');
            $table->foreign('flujo_documento_id')->references('id')->on('flujo_documentos')->onDelete('cascade');
            $table->foreign('tramite_id')->references('id')->on('tipo_tramite')->onDelete('cascade');
            $table->foreign('programa_id')->references('id')->on('programas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historial_usuarios');
    }
};
