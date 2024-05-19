<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialFlujoDocumento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_documento',
        'id_programa_anterior',
        'obs_anterior',
        'fecha_recepcion_anterior',
        'fecha_envio_anterior',
        'fecha_modificacion',
        'created_at',
    ];

    // Relación con el documento
    public function documento()
    {
        return $this->belongsTo(Documento::class, 'id_documento');
    }

    // Relación con el programa
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa_anterior');
    }
}