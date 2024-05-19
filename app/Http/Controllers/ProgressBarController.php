<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;

class ProgressBarController extends Controller
{
    public function showProgressBar()
    {
        // Obtener todos los programas
        $programas = Programa::all();

        // Inicializar un array asociativo para almacenar la cantidad de documentos en proceso por programa
        $documentosEnProcesoPorPrograma = [];

        // Inicializar variables para el total de documentos
        $totalDocumentos = 0;

        // Iterar sobre cada programa para contar los documentos en proceso
        foreach ($programas as $programa) {
            // Obtener la cantidad de documentos en proceso para el programa actual
            $documentosEnProceso = $programa->documentos()->where('estado', '')->count();

            // Agregar la cantidad de documentos en proceso al array asociativo con el nombre del programa como clave
            $documentosEnProcesoPorPrograma[$programa->nombre] = $documentosEnProceso;

            // Incrementar el total de documentos con la cantidad de documentos del programa
            $totalDocumentos += $programa->documentos()->count();
        }

        // Calcular el progreso en base a la cantidad de documentos en proceso y el total de documentos
        $progreso = $totalDocumentos > 0 ? ($documentosEnProceso / $totalDocumentos) * 100 : 0;

        return view('gestion.flujodocumentos.buscar', compact('progreso', 'documentosEnProcesoPorPrograma'));
    }
}

