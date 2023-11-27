<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlujoTramite extends Model
{
    protected $fillable = ['id_tipo_tramite', 'id_programa', 'orden', 'tiempo', 'estado'];

    public function tipoTramite()
    {
        return $this->belongsTo(TipoTramite::class, 'id_tipo_tramite', 'id');
    }

    // Relationship: FlujoTramite belongs to Programa
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa', 'id_programa');
    }
}