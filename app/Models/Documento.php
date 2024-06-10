<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Documento extends Model
{
    protected $table = 'documentos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
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

    public function tiposTramite()
    {
        return $this->hasMany(TipoTramite::class, 'id');
    }

    // Método para obtener todos los documentos
    public static function getAllDocuments()
    {
        return DB::select('SELECT * FROM documentos');
    }

    // Método para obtener un documento por su ID
    public static function getDocumentById($id)
    {
        return DB::select('SELECT * FROM documentos WHERE id = ?', [$id]);
    }

    // Método para obtener documentos recibidos basados en un programa específico
    public static function getReceivedDocuments($programa)
    {
        return DB::select('SELECT * FROM documentos WHERE id_programa = ?', [$programa]);
    }

    // Método para obtener documentos enviados basados en un programa específico
    public static function getSentDocuments($programa)
    {
        return DB::select('SELECT * FROM documentos WHERE id_programa != ?', [$programa]);
    }
    public static function list_documents_origen()
    {
        $query = DB::table('documentos')
            ->select('id', 'cite', 'descripcion', 'estado', 'id_tipo_documento', 'id_programa')
            ->where('id_programa', 'DBU')
            ->get();

        return $query;
    }

    public static function list_documents_destino()
    {
        return Documento::select('documentos.id', 'documentos.cite', 'documentos.descripcion', 'documentos.estado', 'documentos.id_tipo_documento', 'documentos.id_programa', 'programas.programa')
            ->join('programas', function ($join) {
                $join->on('documentos.id_programa', '=', 'programas.id_programa')
                    ->whereNotIn('programas.programa', ['DBU', 'DEPARTAMENTO DE BIENESTAR UNIVERSITARIO']);
            })
            ->get();
    }
    // Método para insertar un nuevo documento
    public static function createDocument($data)
    {
        DB::insert('INSERT INTO documentos (cite, descripcion, estado, hash, id_tipo_documento, documento, id_programa) VALUES (?, ?, ?, ?, ?, ?, ?)', [
            $data['cite'],
            $data['descripcion'],
            $data['estado'],
            $data['hash'],
            $data['id_tipo_documento'],
            $data['documento'], // Asegúrate de manejar el archivo como Blob
            $data['id_programa']
        ]);
    }

    // Método para actualizar un documento existente
    public static function updateDocument($id, $data)
    {
        DB::update('UPDATE documentos SET cite = ?, descripcion = ?, estado = ?, hash = ?, id_tipo_documento = ?, documento = ?, id_programa = ? WHERE id = ?', [
            $data['cite'],
            $data['descripcion'],
            $data['estado'],
            $data['hash'],
            $data['id_tipo_documento'],
            $data['documento'], // Asegúrate de manejar el archivo como Blob
            $data['id_programa'],
            $id
        ]);
    }

    // Método para eliminar un documento
    public static function deleteDocument($id)
    {
        DB::delete('DELETE FROM documentos WHERE id = ?', [$id]);
    }

    // Método para listar todos los documentos con sus programas
    public static function listDocuments()
    {
        $query = DB::select('SELECT doc.id, doc.cite, doc.descripcion, doc.estado, doc.id_tipo_documento, doc.id_programa, pr.programa 
                             FROM documentos doc 
                             INNER JOIN programas pr ON doc.id_programa = pr.id_programa');
        return $query;
    }

    // Método para listar documentos de origen específicos (por ejemplo, 'DBU')
    public static function listDocumentsOrigen()
    {
        $query = DB::table('documentos')
            ->select('id', 'cite', 'descripcion', 'estado', 'id_tipo_documento', 'id_programa')
            ->where('id_programa', 'DBU')
            ->get();

        return $query;
    }

    // Método para obtener programas por documento
    public static function obtenerProgramasPorDocumento($documentoId)
    {
        $programas = DB::table('flujo_documentos')
            ->select('programas.*')
            ->join('programas', 'flujo_documentos.id_programa', '=', 'programas.id_programa')
            ->where('flujo_documentos.id_documento', $documentoId)
            ->distinct()
            ->get();

        return $programas;
    }
}