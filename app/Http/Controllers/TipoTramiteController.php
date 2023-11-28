<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\TipoTramite;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class TipoTramiteController extends Controller
{
    public function index(Request $request)
    {
        $tipotramite = TipoTramite::all();
        if ($request->ajax()) {
            return DataTables::of($tipotramite)
                ->addColumn('action', function ($data) {
                    $button = '&nbsp;&nbsp;<a href="javascript:void(0)" type="button" data-toggle="tooltip" onclick="editProcess(' . $data->id . ')" class="edit btn btn-primary btn-sm "><i class="fas fa-edit"></i> Editar</a>';
                    $button .= '&nbsp;&nbsp;<button type="button" data-toggle="tooltip" name="deleteDocument" onclick="deleteProcess(' . $data->id . ')" class="delete btn btn-danger btn-sm "><i class="fas fa-trash"></i> Eliminar</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('gestion.tramites.index', compact('tipotramite'));
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
