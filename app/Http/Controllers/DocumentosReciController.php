<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Yajra\DataTables\DataTables;
use App\Models\Documento;
use App\Models\Programa;
use Illuminate\Support\Facades\DB;

class DocumentosReciController extends Controller
{
    /*public function __construct()
{
    $this->middleware(['role:admin|user']); // Asegura que solo usuarios con roles 'admin' o 'user' pueden acceder
    $this->middleware(['permission:view documents'])->only('index');
    $this->middleware(['permission:edit documents'])->only('editDocument'); // Asume que tienes un método `editDocument`
    $this->middleware(['permission:delete documents'])->only('deleteDocument'); // Asume que tienes un método `deleteDocument`
}
*/
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $documentos = Documento::list_documents_destino();

            return DataTables::of($documentos)
                ->addColumn('action', function ($documentos) {
                    $btn = '<a href="javascript:void(0)" type="button" name="viewDocument" onclick="loadPDF(' . $documentos->id . ')" class="view btn btn-yellow btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                    $btn .= '&nbsp;&nbsp;<a href="javascript:void(0)" type="button" data-toggle="tooltip" onclick="editDocument(' . $documentos->id . ')" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</a>';
                    $btn .= '&nbsp;&nbsp;<button type="button" data-toggle="tooltip" name="deleteDocument" onclick="deleteDocument(' . $documentos->id . ')" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Eliminar</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        $programas = Programa::all();
        return view('gestion.documentosreci.index', compact('programas'));
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
        try {
            DB::transaction(function () use ($request) {
                // 1. Leer el archivo PDF
                $archivo = $request->file('documento');
                $contenidoArchivo = file_get_contents($archivo->getRealPath());

                // 2. Convertir el contenido del archivo en binario utilizando pg_escape_bytea
                $contenidoBinario = pg_escape_bytea($this->getConnection(), $contenidoArchivo);

                // 3. Generar un valor hash para el archivo
                $hash = md5($contenidoArchivo);

                // 4. Almacenar el binario en la base de datos utilizando Eloquent
                $documento = new Documento;
                $documento->cite = $request->cite;
                $documento->descripcion = $request->descripcion;
                $documento->estado = $request->estado;
                $documento->id_tipo_documento = $request->id_tipo_documento;
                $documento->hash = $hash;
                $documento->documento = $contenidoBinario; // Guardar el contenido binario
                $documento->id_programa = $request->id_programa;
                $documento->save();
            });

            return redirect()->back()->with('message', '¡Documento guardado exitosamente!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar el documento: ' . $e->getMessage());
        }
    }

    // Función auxiliar para obtener la conexión a la base de datos
    private function getConnection()
    {
        return pg_connect("host=127.0.0.1 dbname=docs-app user=postgres password=postgres");
    }

    public function update(Request $request, $id)
    {
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
        $documento->id_programa = $request->id_programa;
        $documento->documento = $contenidoBinario; // Guardar el contenido binario
        //$documento->name_document = $name_document;

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
