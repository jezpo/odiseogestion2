<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TipoTramite extends Model
{
    
    protected $table = 'tipo_tramite';
    protected $fillable = ['tramite', 'estado'];

    public function flujoTramites()
    {
        return $this->hasMany(FlujoTramite::class, 'id_tipo_tramite', 'id');
    }
}