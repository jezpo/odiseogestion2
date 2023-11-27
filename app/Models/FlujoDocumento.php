<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Documentos;
use App\Models\Programa;

class FlujoDocumentos extends Model
{
    protected $fillable = ['id_documento', 'fecha_recepcion', 'id_programa', 'obs'];

    public function documento()
    {
        return $this->belongsTo(Documentos::class, 'id_documento', 'id');
    }

    // Relationship: FlujoDocumento belongs to Programa
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa', 'id_programa');
    }
}