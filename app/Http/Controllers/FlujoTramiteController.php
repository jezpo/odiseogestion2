<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Programa;
use App\Models\FlujoTramite;
use App\Models\TipoTramite;
use Yajra\DataTables\Facades\DataTables;

class FlujoTramiteController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $dataflu = FlujoTramite::obtenerDatosParaDataTables();
            return DataTables::of($dataflu)
                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" type="button" data-toggle="tooltip" name="editramite" onclick="editramite(' . $data->id . ')" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</a>';
                    $button .= '&nbsp;&nbsp;<button type="button" data-toggle="tooltip" name="deleteFlujo" onclick="deleteTramite(' . $data->id . ')" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Eliminar</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        $tipotramite = TipoTramite::all();
        $programas = Programa::all();

        return view('gestion.flujotramite.index', compact('tipotramite', 'programas'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_tipo_tramite' => 'required',
            'orden' => 'required',
            'tiempo' => 'required',
            'estado' => 'required',
            'id_programa' => 'required',
        ]);

        $data = FlujoTramite::create($data);

        if ($request->ajax()) {
            // Si la solicitud es AJAX, devuelve una respuesta JSON
            return response()->json(['status' => 'success', 'message' => 'Registro creado exitosamente.']);
        }

        return redirect()
            ->back()
            ->with('success', 'Registro creado exitosamente.');
    }

    public function edit($id)
    {
        $flujoTramite = FlujoTramite::find($id);
        $tiposTramite = TipoTramite::all();
        $programas = Programa::all();

        if (!$flujoTramite) {
            return response()->json(['success' => false, 'message' => 'Flujo de Trámite no encontrado'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $flujoTramite,
            'tiposTramite' => $tiposTramite,
            'programas' => $programas,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Valida los datos recibidos del formulario
        $data = $request->validate([
            'id_tipo_tramite' => 'required',
            'orden' => 'required',
            'tiempo' => 'required',
            'estado' => 'required',
            'id_programa' => 'required',
        ]);

        // Encuentra el flujo de trámite por su ID
        $flujoTramite = FlujoTramite::find($id);
        // Actualiza los datos del flujo de trámite
        $flujoTramite->update($data);
        // Carga los tipos de trámite y los programas para volver a mostrar el formulario de edición
        $tiposTramite = TipoTramite::all();
        $programas = Programa::all();
        if ($request->ajax()) {
            // Si la solicitud es AJAX, devuelve una respuesta JSON con los datos y un mensaje
            return response()->json(['success' => true, 'message' => 'Registro actualizado exitosamente.', 'tiposTramite' => $tiposTramite, 'programas' => $programas]);
        } else {
            // Si la solicitud no es AJAX, redirige a la vista de edición con los datos cargados
            return view('vista.de.edicion', compact('flujoTramite', 'tiposTramite', 'programas'))->with('success', 'Registro actualizado exitosamente.');
        }
    }
    public function destroy($id)
    {
        $flujoTramite = FlujoTramite::find($id);
        $flujoTramite->delete();

        if (request()->ajax()) {
            return response()->json(['status' => 'success'], 200);
        }

        return redirect()
            ->route('flujotramite.index')
            ->with('success', 'Trámite eliminado exitosamente');
    }
}
