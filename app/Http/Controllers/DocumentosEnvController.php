<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Yajra\DataTables\DataTables;
use App\Models\Documento;
use App\Models\Programa;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DocumentosEnvController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:documentos-env-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:documentos-env-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:documentos-env-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:documentos-env-view', ['only' => ['show']]);
        $this->middleware('permission:documentos-env-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Obtener la consulta base
            $query = Documento::list_documents_origen();

            return DataTables::of($query)
                ->addColumn('action', function ($documento) {
                    $actionButtons = '';
                    if (Auth::user()->can('documentos-env-view')) {
                        $actionButtons .= '<a href="javascript:void(0)" type="button" name="viewDocument" onclick="loadPDF(' . $documento->id . ')" class="view btn btn-yellow btn-sm"><i class="fas fa-eye" style="color: white;"></i> Ver</a>';
                    }
                    if (Auth::user()->can('documentos-env-edit')) {
                        $actionButtons .= '&nbsp;&nbsp;<a href="javascript:void(0)" type="button" data-toggle="tooltip" onclick="editDocument(' . $documento->id . ')" class="edit btn btn-primary btn-sm"><i class="fas fa-edit" style="color: white;"></i> Editar</a>';
                    }
                    if (Auth::user()->can('documentos-env-delete')) {
                        $actionButtons .= '&nbsp;&nbsp;<button type="button" data-toggle="tooltip" name="deleteDocument" onclick="deleteDocument(' . $documento->id . ')" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt" style="color: white;"></i> Eliminar</button>';
                    }

                    if (empty($actionButtons)) {
                        $actionButtons = '<div style="padding: 5px;"><span style="background-color: #7FFF00; padding: 2px; border-radius: 3px;">Sin Acción</span></div>';
                    }
                    return $actionButtons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // Obtener todos los programas
        $programas = Programa::all();

        // Renderizar la vista con los datos de los programas
        return view('gestion.documentosenv.index', compact('programas'));
    }


    public function edit($id)
    {
        if (request()->ajax()) {
            $documentos = Documento::select('id', 'cite', 'descripcion', 'estado', 'id_tipo_documento')->find($id);
            //$documentos = Documentos::find($id);
        }
        if (!$documentos) {
            return response()->json(['error' => 'Documento no encontrado'], 404);
        }
        return response()->json($documentos);
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'documento' => 'required|file',
            'cite' => 'required|string',
            'descripcion' => 'required|string',
            'estado' => 'required|string',
            'id_tipo_documento' => 'required|integer',

        ]);
        // Establecer la conexión a la base de datos
        $conn = pg_connect("host=127.0.0.1 dbname=docs-app user=postgres password=postgres");

        // 1. Leer el archivo PDF
        $archivo = $request->file('documento');
        //$name_document = time() . '_' . $archivo->getClientOriginalName();
        $contenidoArchivo = file_get_contents($archivo->getRealPath());

        // 2. Convertir el contenido del archivo en binario utilizando pg_escape_bytea
        $contenidoBinario = pg_escape_bytea($conn, $contenidoArchivo);

        // Generar un valor hash para el archivo
        $hash = md5($contenidoArchivo);

        // 3. Almacenar el binario en la base de datos
        $documentos = new Documento;
        $documentos->cite = $request->cite;
        $documentos->descripcion = $request->descripcion;
        $documentos->estado = $request->estado;
        $documentos->id_tipo_documento = $request->id_tipo_documento;
        $documentos->hash = $hash;
        $documentos->documento = $contenidoBinario; // Guardar el contenido binario
        $documentos->id_programa = 'DBU';
        $documentos->save();

        // Cerrar la conexión a la base de datos
        pg_close($conn);

        return redirect()->back()->with('message', '¡Documento guardado exitosamente!');
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'documento' => 'required|file',
            'cite' => 'required|string',
            'descripcion' => 'required|string',
            'estado' => 'required|string',
            'id_tipo_documento' => 'required|integer',

        ]);

        // Establecer la conexión a la base de datos
        $conn = pg_connect("host=127.0.0.1 dbname=docs-app user=postgres password=postgres");

        // 1. Obtener el documento existente de la base de datos
        $documento = Documento::find($id);

        // 2. Leer el archivo PDF actualizado
        $archivo = $request->file('documento');
        //$name_document = time() . '_' . $archivo->getClientOriginalName();
        $contenidoArchivo = file_get_contents($archivo->getRealPath());

        // 3. Convertir el contenido del archivo en binario utilizando pg_escape_bytea
        $contenidoBinario = pg_escape_bytea($conn, $contenidoArchivo);

        // Generar un valor hash para el archivo
        $hash = md5($contenidoArchivo);

        // 4. Actualizar el registro en la base de datos
        $documento->cite = $request->cite;
        $documento->descripcion = $request->descripcion;
        $documento->estado = $request->estado;
        $documento->id_tipo_documento = $request->id_tipo_documento;
        $documento->hash = $hash;
        $documento->documento = $contenidoBinario; // Guardar el contenido binario
        //$documento->name_document = $name_document;
        $documento->id_programa = 'DBU';
        $documento->save();

        // Cerrar la conexión a la base de datos
        pg_close($conn);

        return redirect()->back()->with('message', '¡Documento actualizado exitosamente!');
    }

    public function destroy($id)
    {
        Documento::findOrFail($id)->delete();
        return response()->json(['message' => 'Registro Eliminado exitosamante']);
    }


    public function show($id)
    {
        $documento = Documento::select('id', 'cite', 'descripcion', 'estado', 'id_tipo_documento', 'id_programa')->find($id);
        if (!$documento) {
            return response()->json(['error' => 'Documento no encontrado'], 404);
        }
        return response()->json($documento);
    }

    //como convierto pdf para la vista 

    public function downloadPdf($id)
    {
        $documento = Documento::find($id);

        // Si el documento existe
        if ($documento) {
            // Si el documento está almacenado como un recurso, convertirlo a una cadena de bytes
            $pdfData = is_resource($documento->documento) ? stream_get_contents($documento->documento) : $documento->documento;
            // Codificar el documento a base64
            $pdfBase64 = base64_encode($pdfData);
            return response()->json(['base64' => $pdfBase64]);
        } else {
            return response()->json(['message' => 'Documento no encontrado'], 404);
        }
    }

}