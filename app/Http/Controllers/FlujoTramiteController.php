<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Programa;
use App\Models\FlujoTramite;
use App\Models\TipoTramite;
use Yajra\DataTables\Facades\DataTables;

class FlujoTramiteController extends Controller
{
   /* public function __construct(){
        $this->middleware('role_or_permission:view user|view user|view flujo tramite', ['only'=>['index']]);
        $this->middleware('role_or_permission:create user|create user|create flujo tramite', ['only'=>['create','store']]);
        $this->middleware('role_or_permission:edit user|edit user|edit flujo tramite', ['only'=>['edit','update']]);
        $this->middleware('role_or_permission:delete user|delete user|delete flujo tramite', ['only'=>['destroy']]);
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

        return response()->json([
            'flujoTramite' => $flujoTramite,
            'tiposTramite' => $tiposTramite,
            'programas' => $programas,
        ]);
    }

    public function update(Request $request, $id)
    {
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
