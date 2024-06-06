<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\TipoTramite;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;


class TipoTramiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tramite-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:tramite-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tramite-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:tramite-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Obtener todos los trámites
            $tipotramite = TipoTramite::all();
            $data = [];

            // Construir los datos para DataTables
            foreach ($tipotramite as $tramite) {
                $rowData = [
                    'id' => $tramite->id,
                    'tramite' => $tramite->tramite,
                    'estado' => $tramite->estado,
                ];
                if (Auth::user()->can('tramite-edit') || Auth::user()->can('tramite-delete')) {
                    // Si el usuario tiene permiso para editar o eliminar trámites, agregamos los botones
                    $rowData['action'] = '<a href="javascript:void(0)" type="button" data-toggle="tooltip" onclick="editProcess(' . $tramite->id . ')" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</a>';
                    $rowData['action'] .= '&nbsp;&nbsp;<button type="button" data-toggle="tooltip" name="deleteDocument" onclick="deleteProcess(' . $tramite->id . ')" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Eliminar</button>';
                } else {
                    // Si no tiene permisos, mostramos Sin Acción
                    $rowData['action'] = '<div style="padding: 5px;"><span style="background-color: #7FFF00; padding: 2px; border-radius: 3px;">Sin Acción</span></div>';
                }
                $data[] = $rowData;
            }

            // Devolver los datos como JSON
            return response()->json([
                'draw' => intval($request->input('draw')),
                'recordsTotal' => $tipotramite->count(),
                'recordsFiltered' => $tipotramite->count(),
                'data' => $data,
            ]);
        }

        return view('gestion.tramites.index');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tramite' => 'required',
            'estado' => 'required|in:A,I'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $tipotramite = TipoTramite::create([
            'tramite' => $request->tramite,
            'estado' => $request->estado
        ]);

        if ($tipotramite) {
            return response()->json(['status' => 'success', 'message' => 'Trámite creado correctamente']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Ocurrió un error al crear el trámite']);
        }
    }
    public function show($id)
    {
        $tipoTramite = TipoTramite::findOrFail($id);
        return view('documentos.tramites.index', compact('tipoTramite'));
    }
    public function edit($id)
    {
        $tipoTramite = TipoTramite::find($id);

        if (!$tipoTramite) {
            return response()->json(['status' => 'error', 'message' => 'Trámite no encontrado']);
        }

        return response()->json(['status' => 'success', 'data' => $tipoTramite]);
    }

    public function update(Request $request, $id)
    {

        $programa = TipoTramite::find($id);

        if (!$programa) {
            return response()->json(['status' => 'error', 'message' => 'Trámite no encontrado']);
        }

        $programa->tramite = $request->tramite;
        $programa->estado = $request->estado;

        $programa->save();

        return response()->json(['status' => 'success', 'message' => 'Trámite actualizado correctamente']);
    }

    public function destroy($id)
    {

        $programa = TipoTramite::findOrFail($id);
        $programa->delete();

        return response()->json(['status' => 'success', 'message' => 'Trámite eliminado correctamente']);
    }
}
