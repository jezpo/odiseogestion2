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
    /* public function __construct()
        {
            $this->middleware(['role:admin|user']); // Asegura que solo usuarios con roles 'admin' o 'user' pueden acceder
            $this->middleware('auth');
            $this->middleware(['permission:view documents'])->only('index'); 
            $this->middleware(['permission  :create documents'])->only('create');           
            $this->middleware(['permission  :edit documents'])->only('edit');
            $this->middleware(['permission  :delete documents'])->only('delete');
        }*/
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

        // Verificar si se encontró el flujo de trámite
        if (!$flujoTramite) {
            return response()->json([
                'success' => 'error',
                'message' => 'Flujo de Trámite no encontrado',
            ], 404);
        }

        return response()->json([
            'success' => 'success',
            'data' => $flujoTramite, // Aquí envía los datos que deseas recibir en el frontend
            'tiposTramite' => $tiposTramite,
            'programas' => $programas,
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'id_tipo_tramite' => 'required',
            'orden' => 'required',
            'tiempo' => 'required',
            'estado' => 'required',
            'id_programa' => 'required',
        ]);

        // Encuentra el registro a actualizar
        $flujoTramite = FlujoTramite::findOrFail($id);

        // Actualiza los datos del registro
        $flujoTramite->update($data);

        if ($request->ajax()) {
            // Si la solicitud es AJAX, devuelve una respuesta JSON
            return response()->json(['success' => 'Registro actualizado exitosamente.']);
        }

        return redirect()
            ->back()
            ->with('success', 'Registro actualizado exitosamente.');
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
