<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up()
    {
        Schema::create('tipo_tramite', function (Blueprint $table) {
            $table->id();
            $table->string('tramite');
            $table->char('estado', 1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_tramite');
    }
};
