<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TipoTramite extends Model
{

    protected $table = 'tipo_tramite';
    protected $fillable = ['tramite', 'estado'];
    public $timestamps = false;

    public function flujoTramites()
    {
        return $this->hasMany(FlujoTramite::class, 'id_tipo_tramite', 'id');
    }
    
    public function documento()
    {
        return $this->belongsTo(Documento::class, 'id');
    }
}