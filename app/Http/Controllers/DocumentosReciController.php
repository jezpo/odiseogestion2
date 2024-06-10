<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Yajra\DataTables\DataTables;
use App\Models\Documento;
use App\Models\Programa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DocumentosReciController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:documentos-reci-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:documentos-reci-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:documentos-reci-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:documentos-reci-view', ['only' => ['show']]);
        $this->middleware('permission:documentos-reci-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Obtener la consulta base
            $query = Documento::list_documents_destino();

            return DataTables::of($query)
                ->addColumn('action', function ($documento) {
                    $actionButtons = '';
                    if (Auth::user()->can('documentos-reci-view')) {
                        $actionButtons .= '<a href="javascript:void(0)" type="button" name="viewDocument" onclick="loadPDF(' . $documento->id . ')" class="view btn btn-yellow btn-sm"><i class="fas fa-eye" style="color: white;"></i> Ver</a>';
                    }
                    if (Auth::user()->can('documentos-reci-edit')) {
                        $actionButtons .= '&nbsp;&nbsp;<a href="javascript:void(0)" type="button" data-toggle="tooltip" onclick="editDocument(' . $documento->id . ')" class="edit btn btn-primary btn-sm"><i class="fas fa-edit" style="color: white;"></i> Editar</a>';
                    }
                    if (Auth::user()->can('documentos-reci-delete')) {
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

        //$documentos = Documento::with('programa')->get();

        // Obtener todos los programas
        $programas = Programa::all();

        // Renderizar la vista con los datos de los programas
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
        $request->validate([
            'file' => 'sometimes|file|mimes:pdf|max:102400', // 100 MB
            'cite' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'estado' => 'required|string',
            'id_tipo_documento' => 'required|integer',
            'id_programa' => 'required|string|max:5'
        ]);

        try {
            $documento = new Documento;
            $documento->cite = $request->cite;
            $documento->descripcion = $request->descripcion;
            $documento->estado = $request->estado;
            $documento->id_tipo_documento = $request->id_tipo_documento;
            $documento->id_programa = $request->id_programa;

            if ($request->hasFile('file')) {
                $uploadedFile = $request->file('file');
                $documento->documento = file_get_contents($uploadedFile->getRealPath());
            }

            $documento->save();

            return redirect()->route('documentos_enviados.index')->with('success', '¡Documento enviado guardado exitosamente!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar el documento enviado: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'sometimes|file|mimes:pdf|max:102400', // 100 MB
            'cite' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'estado' => 'required|string',
            'id_tipo_documento' => 'required|integer',
            'id_programa' => 'required|string|max:5'
        ]);

        try {
            $documento = Documento::find($id);
            $documento->cite = $request->cite;
            $documento->descripcion = $request->descripcion;
            $documento->estado = $request->estado;
            $documento->id_tipo_documento = $request->id_tipo_documento;
            $documento->id_programa = $request->id_programa;

            if ($request->hasFile('file')) {
                $uploadedFile = $request->file('file');
                $documento->documento = file_get_contents($uploadedFile->getRealPath());
            }

            $documento->save();

            return redirect()->route('documentos_enviados.index')->with('success', '¡Documento enviado actualizado exitosamente!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el documento enviado: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        Documento::findOrFail($id)->delete();
        return response()->json(['message' => 'Registro Eliminado exitosamante']);
    }


    public function show($id)
    {
        $documento = Documento::with('programa')->findOrFail($id);

        return response()->json([
            'id' => $documento->id,
            'cite' => $documento->cite,
            'descripcion' => $documento->descripcion,
            'estado' => $documento->estado,
            'programa' => $documento->programa ? $documento->programa->nombre : null, // Nombre del programa
            'id_tipo_documento' => $documento->id_tipo_documento,
            'pdf_url' => $documento->pdf_url // URL del archivo PDF
        ]);
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
