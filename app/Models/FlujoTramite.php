<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class FlujoTramite extends Model
{
    use HasFactory;
    protected $table = 'flujo_tramite';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['id_tipo_tramite', 'id_programa', 'orden', 'tiempo', 'estado'];
    public function tipoTramite()
    {
        return $this->belongsTo(TipoTramite::class, 'id_tipo_tramite', 'id');
    }

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa', 'id_programa');
    }

    public function getNombreTipoTramiteAttribute()
    {
        return $this->tipoTramite->tramite;
    }

    public function getNombreProgramaAttribute()
    {
        return $this->programa->programa;
    }

    public static function obtenerDatosParaDataTables()
    {
        $query = DB::select('
            SELECT
                ft.id,
                tt.tramite AS tipo_tramite,
                ft.orden,
                ft.tiempo,
                ft.estado,
                p.programa,
                ft.id_programa,
                ft.estado AS estado_flujo_tramite
            FROM
                flujo_tramite ft
            LEFT JOIN
                tipo_tramite tt ON ft.id_tipo_tramite = tt.id
            LEFT JOIN
                programas p ON ft.id_programa = p.id_programa
        ');

        return $query;
    }
}