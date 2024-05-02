<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Documentos;
use App\Models\Programa;
use App\Models\FlujoDocuments;
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
                    $button = '<a href="javascript:void(0)" type="button" data-toggle="tooltip" name="editTramite" onclick="editTramite(' . $data->id . ')" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</a>';
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
    public function create(Request $request)
    {
        $flujoTramite = FlujoTramite::create([
            'id_tipo_tramite' => $request->id_tipo_tramite,
            'id_programa' => $request->id_programa,
            'orden' => $request->orden,
            'tiempo' => $request->tiempo,
            'estado' => $request->estado,
        ]);

        if ($request->ajax()) {
            // Si la solicitud es AJAX, devuelve una respuesta JSON
            return response()->json(['message' => 'Flujo de documentos creado con éxito', 'flujotramite' => $flujoTramite]);
        } else {
            // Si la solicitud no es AJAX, realiza una redirección
            return back()->with('success', 'Flujo de documentos creado con éxito');
        }
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

        $flujoTramite = FlujoTramite::create($data);

        if ($request->ajax()) {
            // Si la solicitud es AJAX, devuelve una respuesta JSON
            return response()->json(['success' => 'Registro creado exitosamente.', 'flujoTramite' => $flujoTramite], 200);
        }

        return redirect()
            ->back()
            ->with('success', 'Registro creado exitosamente.');
    }
    public function show($id)
    {
        $flujoTramite = FlujoTramite::findOrFail($id);
        return view('hermes::flujodetramite.show', compact('flujoTramite'));
    }

    public function edit($id)
    {
        $flujoTramite = FlujoTramite::find($id);
        $tiposTramite = TipoTramite::all();
        $programas = Programa::all();

        return response()->json([
            'flujoTramite' => $flujoTramite,
            'tiposTramite' => $tiposTramite,
            'programas' => $programas,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_tipo_tramite' => 'required',
            'orden' => 'required',
            'tiempo' => ['required', 'date_format:H:i'],
            'estado' => 'required',
            'id_programa' => 'required',
        ]);

        $flujoTramite = FlujoTramite::findOrFail($id);
        $flujoTramite->update($request->all());

        if ($request->ajax()) {
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Flujo de Trámite actualizado exitosamente',
                    'flujoTramite' => $flujoTramite,
                ],
                200,
            );
        }

        return redirect()
            ->route('flujodetramite.edit', ['id' => $id])
            ->with('success', 'Flujo de Trámite actualizado exitosamente');
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
