<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\TipoTramiteController;
use App\Http\Controllers\FlujoTramiteController;
use App\Http\Controllers\FlujoDocumentoController;
use App\Http\Controllers\DocumentosEnvController;
use App\Http\Controllers\DocumentosReciController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Otras rutas autenticadas existentes

    // Rutas adicionales para DocumentosEnvController y DocumentosReciController
    Route::get('/dashboard/documentos-env', [DocumentosEnvController::class, 'index']);
    Route::get('/dashboard/documentos-reci', [DocumentosReciController::class, 'index']);

    // Rutas para ProgramaController, TipoTramiteController, FlujoTramiteController y FlujoDocumentoController
    Route::get('/programas', [ProgramaController::class, 'index']);
    Route::get('/dashboard/tipo-tramites', [TipoTramiteController::class, 'index'])->name('tipo-tramites');
    Route::get('/dashboard/flujo-tramites', [FlujoTramiteController::class, 'index']);
    Route::get('/dashboard/flujo-documentos', [FlujoDocumentoController::class, 'index']);
});

Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

