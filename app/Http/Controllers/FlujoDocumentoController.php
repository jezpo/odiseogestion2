<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Documento;
use App\Models\Programa;
use App\Models\FlujoDocumento;
class FlujoDocumentoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FlujoDocumento::list_documents_with_flow();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    // Botones de acción, por ejemplo: Editar y Eliminar
                    $btn = '<a href="javascript:void(0)" type="button" data-toggle="tooltip" name="editFlujo" onclick="editFlujo(' . $data->id . ')" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</a>';
                    $btn .= '&nbsp;&nbsp;<button type="button" data-toggle="tooltip" name="deleteDocument" onclick="deleteFlujo(' . $data->id . ')" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Eliminar</button>';
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
        $flujos = FlujoDocumento::create([
            'id_documento' => $request->id_documento,
            'fecha_recepcion' => $request->fecha_recepcion ?? now(),
            'fecha_envio' => $request->fecha_envio ?? now(),
            'id_programa' => $request->id_programa,
            'obs' => $request->obs,
        ]);

        if ($request->ajax()) {
            // Si la solicitud es AJAX, devuelve una respuesta JSON
            return response()->json(['message' => 'Flujo de documentos creado con éxito', 'flujos' => $flujos]);
        } else {
            // Si la solicitud no es AJAX, realiza una redirección
            return back()->with('success', 'Flujo de documentos creado con éxito');
        }
    }

    public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'id_documento' => 'required',
            'fecha_recepcion' => 'required',
            'fecha_envio' => 'required',
            'id_programa' => 'required|max:5',
            'obs' => 'nullable',
        ]);

        // Crea un nuevo registro utilizando los datos del formulario
        $nuevoRegistro = new FlujoDocumento([
            'id_documento' => $request->input('id_documento'),
            'fecha_recepcion' => $request->input('fecha_recepcion'),
            'fecha_envio' => $request->input('fecha_envio'),
            'id_programa' => $request->input('id_programa'),
            'obs' => $request->input('obs'),
        ]);

        $nuevoRegistro->save(); // Guarda el nuevo registro en la base de datos

        // Redirige a la vista de detalles o lista de registros creados
        return redirect()
            ->back()
            ->with('success', 'Registro creado con éxito');
    }

    public function show($id)
    {
        // Carga la relación programa
        $flujo = FlujoDocumento::with('programa')->find($id);
        // Accede al nombre a través del atributo accesor
        $programa = $flujo->programa;
        return response()->json($flujo);
    }

    public function edit($id)
    {
        $flujoDocumento = FlujoDocumento::find($id);
        return response()->json($flujoDocumento);
    }

    public function update(Request $request, $id)
    {
        // Valida los datos del formulario
        $request->validate([
            'id_documento' => 'required',
            //'fecha_recepcion' => 'required|date',
            //'fecha_envio' => 'required|date',
            'id_programa' => 'required|max:5',
            'obs' => 'nullable',
        ]);

        try {
            // Encuentra el registro que se va a actualizar
            $flujoDocumento = FlujoDocumento::findOrFail($id);

            // Actualiza los campos del registro con los datos del formulario
            $flujoDocumento->id_documento = $request->input('id_documento');
            $flujoDocumento->fecha_recepcion = $request->input('fecha_recepcion');
            $flujoDocumento->fecha_envio = $request->input('fecha_envio');
            $flujoDocumento->id_programa = $request->input('id_programa');
            $flujoDocumento->obs = $request->input('obs');

            // Guarda los cambios en la base de datos
            $flujoDocumento->save();

            // Redirige a la vista de detalles o lista de registros actualizados
            return redirect()
                ->back()
                ->with('success', 'Registro actualizado con éxito');
        } catch (\Exception $e) {
            // En caso de error, manejar la excepción
            return redirect()
                ->back()
                ->with('error', 'Error al actualizar el registro: ' . $e->getMessage());
        }
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
}
