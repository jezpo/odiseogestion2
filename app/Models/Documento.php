<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Documentos extends Model
{
    use HasFactory;

    protected $fillable = ['cite', 'descripcion', 'estado', 'hash', 'id_tipo_documento', 'documento', 'id_programa'];

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa', 'id_programa');
    }

    public function flujoDocumentos()
    {
        return $this->hasMany(FlujoDocumentos::class);
    }

    public static function list_documents()
    {
        $query = DB::select('select doc.id,doc.cite,doc.descripcion,doc.estado,doc.id_tipo_documento,doc.id_programa,pr.programa from documentos doc inner join programas pr on doc.id_programa = pr.id_programa ');
        return $query;
    }

    public static function list_documents_origen()
    {
        return Documentos::select('documentos.id', 'documentos.cite', 'documentos.descripcion', 'documentos.estado', 'documentos.id_tipo_documento', 'documentos.id_programa', 'programas.programa')
            ->join('programas', 'documentos.id_programa', '=', 'programas.id_programa')
            ->where(function ($query) {
                $query->where('programas.programa', '=', 'DBU')
                    ->orWhere('programas.programa', '=', 'DEPARTAMENTO DE BIENESTAR UNIVERSITARIO');
            })
            ->get();
    }

    public static function list_documents_destino()
    {
        return Documentos::select('documentos.id', 'documentos.cite', 'documentos.descripcion', 'documentos.estado', 'documentos.id_tipo_documento', 'documentos.id_programa', 'programas.programa')
            ->join('programas', 'documentos.id_programa', '=', 'programas.id_programa')
            ->where('programas.programa', '!=', 'DBU')
            ->where('programas.programa', '!=', 'DEPARTAMENTO DE BIENESTAR UNIVERSITARIO')
            ->get();
    }
}