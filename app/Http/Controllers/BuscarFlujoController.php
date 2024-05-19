<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use App\Models\FlujoDocumento;
use Illuminate\Support\Facades\DB;

class BuscarFlujoController extends Controller
{
    public function index()
    {
        return view('gestion.flujodocumentos.buscar');
    }

    public function progreso($id)
    {
        // Aquí implementa la lógica para recuperar el progreso del flujo de documentos
        $documento = Documento::find($id);
        $etapas = $this->calcularProgreso($documento);

        return response()->json(['etapas' => $etapas]);
    }

    private function calcularProgreso($documento)
    {
        $tiposTramite = DB::table('tipo_tramite')
            ->join('documentos', 'tipo_tramite.id', '=', 'documentos.id')
            ->select('tipo_tramite.*')
            ->where('documentos.id', $documento->id)
            ->get();

        $etapas = [];

        if ($tiposTramite->isNotEmpty()) {
            foreach ($tiposTramite as $tipoTramite) {
                $descripcion = property_exists($tipoTramite, 'descripcion') ? $tipoTramite->descripcion : 'Descripción no disponible';
                $programas = FlujoDocumento::obtenerProgramasPorDocumento($documento->id);

                if ($programas->isNotEmpty()) {
                    foreach ($programas as $programa) {
                        $etapas[] = [
                            'nombre' => $tipoTramite->tramite,
                            'descripcion' => $descripcion,
                            'programa' => $programa->programa,
                        ];
                    }
                } else {
                    $etapas[] = [
                        'nombre' => $tipoTramite->tramite,
                        'descripcion' => $descripcion,
                        'mensaje' => 'No se encontraron programas asociados al tipo de trámite',
                    ];
                }
            }
        } else {
            $etapas[] = [
                'mensaje' => 'No se encontraron tipos de trámite asociados al documento',
            ];
        }
        return $etapas;
    }
}

