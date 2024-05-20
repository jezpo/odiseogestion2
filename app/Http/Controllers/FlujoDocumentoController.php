<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Documento;
use App\Models\Programa;
use App\Models\FlujoDocumento;
use App\Models\FlujoTramite;
use App\Models\TipoTramite;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class FlujoDocumentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:flujo-documento-list', ['only' => ['index']]);
        $this->middleware('permission:flujo-documento-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:flujo-documento-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:flujo-documento-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FlujoDocumento::list_documents_with_flow();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    $btn = '';
                    if (Auth::user()->can('flujo-documento-edit')) {
                        $btn .= '<a href="javascript:void(0)" type="button" data-toggle="tooltip" name="editFlujo" onclick="editFlujo(' . $data->id . ')" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</a>';
                    }
                    if (Auth::user()->can('flujo-documento-delete')) {
                        $btn .= '&nbsp;&nbsp;<button type="button" data-toggle="tooltip" name="deleteDocument" onclick="deleteFlujo(' . $data->id . ')" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Eliminar</button>';
                    }
                    return $btn;
                })
                ->rawColumns(['actions'])
                ->toJson();
        }

        $documentos = Documento::all();
        $programas = Programa::all();
        return view('gestion.flujodocumentos.index', compact('documentos', 'programas'));
    }

    public function create(Request $request)
    {
        // Establecer el huso horario a América/La_Paz
        $currentDateTime = Carbon::now('America/La_Paz')->toDateTimeLocalString();

        // Crear el flujo de documentos con la fecha y hora actual
        $flujo = FlujoDocumento::create([
            'id_documento' => $request->id_documento,
            'fecha_recepcion' => $request->fecha_recepcion ?? $currentDateTime,
            'fecha_envio' => $request->fecha_envio ?? $currentDateTime,
            'id_programa' => $request->id_programa,
            'obs' => $request->obs,
        ]);

        if ($request->ajax()) {
            // Si la solicitud es AJAX, devuelve una respuesta JSON
            return response()->json(['message' => 'Flujo de documentos creado con éxito', 'flujo' => $flujo]);
        } else {
            // Si la solicitud no es AJAX, retorna la vista con la variable $currentDateTime
            return view('gestion.flujodocumentos.index', compact('currentDateTime'))
                ->with('success', 'Flujo de documentos creado con éxito');
        }
    }

    public function store(Request $request)
    {
        $fechaRecepcion = Carbon::createFromFormat('Y-m-d\TH:i:s', $request->input('fecha_recepcion'))->format('Y-m-d H:i');
        $fechaEnvio = Carbon::createFromFormat('Y-m-d\TH:i:s', $request->input('fecha_envio'))->format('Y-m-d H:i');

        $rules = [
            'id_documento' => 'required',
            'fecha_recepcion' => 'required|date|after_or_equal:' . Carbon::now()->format('Y-m-d H:i'),
            'fecha_envio' => 'required|date',
            'id_programa' => 'required|max:5',
            'obs' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        FlujoDocumento::create([
            'id_documento' => $request->id_documento,
            'fecha_recepcion' => $fechaRecepcion,
            'fecha_envio' => $fechaEnvio,
            'id_programa' => $request->id_programa,
            'obs' => $request->obs,
        ]);

        return redirect()->route('gestion.flujodocumentos.index')->with('success', 'Flujo de documentos creado con éxito');
    }
    /*public function show($id)
    {
        // Carga la relación programa
        $flujo = FlujoDocumento::with('programa')->find($id);
        // Accede al nombre a través del atributo accesor
        $programa = $flujo->programa;
        return response()->json($flujo);
    }*/

    public function edit($id)
    {
        $flujoDocumento = FlujoDocumento::find($id);
        return response()->json($flujoDocumento);
    }

    public function update(Request $request, $id)
    {
        $fechaRecepcion = Carbon::createFromFormat('Y-m-d\TH:i:s', $request->input('fecha_recepcion'))->format('Y-m-d H:i');
        $fechaEnvio = Carbon::createFromFormat('Y-m-d\TH:i:s', $request->input('fecha_envio'))->format('Y-m-d H:i');

        $request->validate([
            'id_documento' => 'required',
            'fecha_recepcion' => 'required|date|after_or_equal:' . Carbon::now()->format('Y-m-d H:i'),
            'fecha_envio' => 'required|date',
            'id_programa' => 'required|max:5',
            'obs' => 'nullable',
        ]);

        $flujoDocumento = FlujoDocumento::findOrFail($id);
        $flujoDocumento->update([
            'id_documento' => $request->id_documento,
            'fecha_recepcion' => $fechaRecepcion,
            'fecha_envio' => $fechaEnvio,
            'id_programa' => $request->id_programa,
            'obs' => $request->obs,
        ]);

        return redirect()->back()->with('success', 'Registro actualizado con éxito');
    }

    public function destroy($id)
    {
        $flujo = FlujoDocumento::findOrFail($id);

        if ($flujo) {
            $flujo->delete();
            return response()->json(['success' => 'Eliminado con éxito']);
        } else {
            return response()->json(['success' => 'Documento no encontrado'], 404);
        }
    }
    public function showForm()
    {
        $currentDateTime = Carbon::now()->format('Y-m-d\TH:i');
        view()->share('currentDateTime', $currentDateTime);
        return view('gestion.flujodocumentos.index');
    }
}

