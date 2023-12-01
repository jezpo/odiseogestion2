<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Documento;
use App\Models\Programa;
use Illuminate\Support\Facades\DB;

class FlujoDocumento extends Model
{
    protected $fillable = ['id_documento', 'fecha_recepcion', 'fecha_envio', 'id_programa', 'obs'];

    public function documento()
    {
        return $this->belongsTo(Documento::class, 'id_documento', 'id');
    }

    // Relationship: FlujoDocumento belongs to Programa
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa', 'id_programa');
    }
    public static function list_documents_with_flow()
    {
        $flujoDocumentos = DB::table('flujo_documentos')
            ->select(
                'flujo_documentos.id',
                'flujo_documentos.id_documento',
                'flujo_documentos.fecha_recepcion',
                'flujo_documentos.fecha_envio',
                'programas.programa as programa',
                'flujo_documentos.obs',
                DB::raw('(SELECT cite FROM documentos WHERE id = flujo_documentos.id_documento) AS cite')
            )
            ->leftJoin('documentos', 'flujo_documentos.id_documento', '=', 'documentos.id')
            ->leftJoin('programas', 'flujo_documentos.id_programa', '=', 'programas.id_programa')
            ->get();

        return $flujoDocumentos;
    }
}