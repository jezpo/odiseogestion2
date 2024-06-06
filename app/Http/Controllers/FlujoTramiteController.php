<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Programa;
use App\Models\FlujoTramite;
use App\Models\TipoTramite;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class FlujoTramiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:flujo-tramite-list', ['only' => ['index']]);
        $this->middleware('permission:flujo-tramite-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:flujo-tramite-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:flujo-tramite-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $dataflu = FlujoTramite::obtenerDatosParaDataTables();

            return DataTables::of($dataflu)
                ->addColumn('action', function ($tramite) {
                    $actionButtons = '';
                    if (Auth::user()->can('flujo-tramite-edit')) {
                        $actionButtons .= '<a href="javascript:void(0)" type="button" data-toggle="tooltip" name="editramite" onclick="editramite(' . $tramite->id . ')" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</a>';
                    }
                    if (Auth::user()->can('flujo-tramite-delete')) {
                        $actionButtons .= '&nbsp;&nbsp;<button type="button" data-toggle="tooltip" name="deleteFlujo" onclick="deleteTramite(' . $tramite->id . ')" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Eliminar</button>';
                    }

                    if (empty($actionButtons)) {
                        $actionButtons = '<div style="padding: 5px;"><span style="background-color: #7FFF00; padding: 2px; border-radius: 3px;">Sin Acción</span></div>';
                    }
                    return $actionButtons;
                })
                ->rawColumns(['action'])
                ->make(true);
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
