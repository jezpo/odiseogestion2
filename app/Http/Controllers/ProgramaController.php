<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use App\Models\Programa; // Updated namespace
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\ModelNotFoundException;

class ProgramaController extends Controller
{
    /*public function __construct()
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
            $programa = Programa::all();
            return DataTables::of($programa)
                ->addColumn('action', function ($programa) {
                    $button = '&nbsp;&nbsp;<a href="javascript:void(0)" type="button" data-toggle="tooltip" onclick="editProgram(' . $programa->id . ')" class="edit btn btn-primary btn-sm "><i class="fas fa-edit"></i> Editar</a>';
                    $button .= '&nbsp;&nbsp;<button type="button" data-toggle="tooltip" name="deleteDocument" onclick="deleteProgram(' . $programa->id . ')" class="delete btn btn-danger btn-sm "><i class="fas fa-trash"></i> Eliminar</button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('gestion.programas.index');
    }

    public function store(Request $request)
    {
        try {
            // Validación de datos
            $request->validate([
                'id_programa' => 'required',
                'programa' => 'required|max:255',
                'id_padre' => 'required|max:255',
                'estado' => 'required|in:A,I',
            ]);

            $programa = new Programa();

            $programa->id_programa = $request->id_programa;
            $programa->programa = $request->programa;
            $programa->id_padre = $request->id_padre;
            $programa->estado = $request->estado;

            $programa->save();

            return response()->json(['success' => true, 'message' => 'Programa registrado con éxito.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Capturar errores de validación
            return response()->json(['success' => false, 'message' => 'Error de validación.', 'errors' => $e->validator->errors()]);
        } catch (\Exception $e) {
            // Capturar otros errores
            return response()->json(['success' => false, 'message' => 'Hubo un error al registrar el programa.', 'exception' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $programa = Programa::findOrFail($id);
            return response()->json($programa);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Programa no encontrado.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_programa' => 'required',
            'programa' => 'required|max:255',
            'id_padre' => 'required|max:255',
            'estado' => 'required|in:A,I',
        ]); 

        $programa = Programa::find($id);
        if ($programa) {
            $programa->id_programa = $request->id_programa;
            $programa->programa = $request->programa;
            $programa->id_padre = $request->id_padre;
            $programa->estado = $request->estado;
            $programa->save();

            return response()->json(['success' => true, 'message' => 'Programa actualizado con éxito.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Programa no encontrado.'], 404);
        }
    }

    public function destroy($id)
    {
        $programa = Programa::find($id);
        if ($programa) {
            $programa->delete();
            return response()->json(['success' => 'Programa eliminado exitosamente.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Programa no encontrado.'], 404);
        }
    }
}

