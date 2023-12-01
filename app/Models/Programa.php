<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Documentos;
use App\Models\FlujoDocumentos;
class Programa extends Model
{
    use HasFactory;
    protected $table = 'programas';
  
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id_programa', 'programa', 'id_padre', 'estado'];

    // Relationship: Programa has many Documentos
    public function documentos()
    {
        return $this->hasMany(Documento::class, 'id_programa', 'id_programa');
    }

    // Relationship: Programa has many FlujoTramites
    public function flujoTramites()
    {
        return $this->hasMany(FlujoTramite::class, 'id_programa', 'id_programa');
    }

    // Relationship: Programa has many FlujoDocumentos
    public function flujoDocumentos()
    {
        return $this->hasMany(FlujoDocumentos::class, 'id_programa', 'id_programa');
    }
}
