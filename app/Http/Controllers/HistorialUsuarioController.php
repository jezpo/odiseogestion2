<?php

namespace App\Http\Controllers;

use App\Models\HistorialUsuario;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class HistorialUsuarioController extends Controller
{
    public function index()
    {
        // Cargar todos los datos incluyendo las relaciones
        $historialUsuarios = HistorialUsuario::with(['user', 'documento', 'flujoTramite', 'flujoDocumento', 'tramite', 'programa'])
            ->orderBy('created_at', 'asc')
            ->get();

        // Pasar los datos a la vista
        return view('historial.index', compact('historialUsuarios'));
    }
}
