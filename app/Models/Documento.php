<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    protected $fillable = ['cite', 'descripcion', 'estado', 'hash', 'id_tipo_documento', 'documento', 'id_programa'];

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa', 'id_programa');
    }
}