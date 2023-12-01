<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Documento extends Model
{
    use HasFactory;

    //protected $connection = 'pgsql';
    protected $table = 'documentos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'cite',
        'descripcion',
        'estado',
        'hash',
        'id_tipo_documento',
        'documento',
        'id_programa'

    ];
    public function programas()
    {
        return $this->belongsTo(Programa::class);
    }

    public function flujoDocumentos()
    {
        return $this->hasMany(FlujoDocumento::class);
    }
    public static function list_documents()
    {
        $query = DB::select('select doc.id,doc.cite,doc.descripcion,doc.estado,doc.id_tipo_documento,doc.id_programa,pr.programa from documentos doc inner join programas pr on doc.id_programa = pr.id_programa ');
        return $query;
    }
    public static function list_documents_origen()
    {
        $query = DB::table('documentos')
            ->select('id', 'cite', 'descripcion', 'estado', 'id_tipo_documento', 'id_programa')
            ->where('id_programa', 'DBU')
            ->get();

        return $query;
    }
    /*public static function list_documents_destino()
    {
        return Documento::select('documentos.id', 'documentos.cite', 'documentos.descripcion', 'documentos.estado', 'documentos.id_tipo_documento', 'documentos.id_programa', 'programas.programa')
            ->join('programas', 'documentos.id_programa', '=', 'programas.id_programa')
            ->where('programas.programa', '!=', 'DBU')
            ->where('programas.programa', '!=', 'DEPARTAMENTO DE BIENESTAR UNIVERSITARIO')
            ->get();
    }*/
    public static function list_documents_destino()
    {
        return Documento::select('documentos.id', 'documentos.cite', 'documentos.descripcion', 'documentos.estado', 'documentos.id_tipo_documento', 'documentos.id_programa', 'programas.programa')
            ->join('programas', function ($join) {
                $join->on('documentos.id_programa', '=', 'programas.id_programa')
                    ->whereNotIn('programas.programa', ['DBU', 'DEPARTAMENTO DE BIENESTAR UNIVERSITARIO']);
            })
            ->get();
    }


}