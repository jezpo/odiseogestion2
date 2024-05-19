<?php

use App\Http\Controllers\BuscarFlujoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\TipoTramiteController;
use App\Http\Controllers\FlujoTramiteController;
use App\Http\Controllers\FlujoDocumentoController;
use App\Http\Controllers\DocumentosEnvController;
use App\Http\Controllers\DocumentosReciController;
use App\Http\Controllers\ProgressBarController;

Route::get('/', function () {
    return view('/login');
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
    Route::group(['middleware' => ['role:super-admin|admin']], function () {
        Route::resource('permissions', App\Http\Controllers\PermissionController::class);
        Route::delete('permissions/{id}', [App\Http\Controllers\PermissionController::class, 'permissions.destroy']);

        Route::resource('roles', App\Http\Controllers\RoleController::class);
        Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
        Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
        Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

        // Ruta para inicializar roles y permisos
        Route::get('/dashboard/init-roles-permissions', [DocumentosEnvController::class, 'initRolesAndPermissions'])->name('init-roles-permissions');

        // Rutas para DocumentsSendController
        Route::get('/dashboard/documentos-env', [DocumentosEnvController::class, 'index'])->name('documentos.index');
        Route::get('/dashboard/documentos-env/{id}', [DocumentosEnvController::class, 'show'])->name('documentos.show');
        Route::get('/dashboard/documentos-env/edit/{id}', [DocumentosEnvController::class, 'edit'])->name('documentos.edit');
        Route::post('/dashboard/documentos-env', [DocumentosEnvController::class, 'store'])->name('documentos.store');
        Route::put('/dashboard/documentos-env/update/{id}', [DocumentosEnvController::class, 'update'])->name('documentos.update');
        Route::delete('/dashboard/documentos-env/destroy/{id}', [DocumentosEnvController::class, 'destroy'])->name('documentos.destroy');
        Route::get('/dashboard/documentos-env/download/{id}', [DocumentosEnvController::class, 'downloadPdf'])->name('documentos.download');

        //rutas para DocumentosReciController
        Route::get('/dashboard/documentos-reci', [DocumentosReciController::class, 'index'])->name('documentosReci.index');
        Route::get('/dashboard/documentos-reci/{id}', [DocumentosReciController::class, 'show'])->name('documentosReci.show');
        Route::get('/dashboard/documentos-reci/edit/{id}', [DocumentosReciController::class, 'edit'])->name('documentosReci.edit');
        Route::post('/dashboard/documentos-reci', [DocumentosReciController::class, 'store'])->name('documentosReci.store');
        Route::put('/dashboard/documentos-reci/update/{id}', [DocumentosReciController::class, 'update'])->name('documentosReci.update');
        Route::delete('/dashboard/documentos-reci/{id}', [DocumentosReciController::class, 'destroy'])->name('documentosReci.destroy');
        Route::get('/dashboard/documentos-reci/download/{id}', [DocumentosReciController::class, 'downloadPdf'])->name('documentosReci.download');



        Route::get('/dashboard/programas', [ProgramaController::class, 'index'])->name('programas.index');
        Route::get('/dashboard/programas/create', [ProgramaController::class, 'create'])->name('programas.create');
        Route::post('/dashboard/programas', [ProgramaController::class, 'store'])->name('programas.store');
        Route::get('/dashboard/programas/{id}', [ProgramaController::class, 'show'])->name('programas.show');
        Route::get('/dashboard/programas/{id}/edit', [ProgramaController::class, 'edit'])->name('programas.edit');
        Route::put('/dashboard/programas/{id}', [ProgramaController::class, 'update'])->name('programas.update');
        Route::delete('/dashboard/programas/destroy/{id}', [ProgramaController::class, 'destroy'])->name('programas.destroy');


        Route::get('/dashboard/tipo-tramites', [TipoTramiteController::class, 'index'])->name('tipo-tramites');
        Route::get('/dashboard/tipo-tramites', [TipoTramiteController::class, 'index'])->name('tipo-tramites.index');
        Route::post('/dashboard/tipo-tramites/create', [TipoTramiteController::class, 'create'])->name('tipo-tramites.create');
        Route::post('/dashboard/tipo-tramites', [TipoTramiteController::class, 'store'])->name('tipo-tramites.store');
        Route::get('/dashboard/tipo-tramites/{id}', [TipoTramiteController::class, 'show'])->name('tipo-tramites.show');
        Route::get('/dashboard/tipo-tramites/edit/{id}', [TipoTramiteController::class, 'edit'])->name('tipo-tramites.edit');
        Route::put('/dashboard/tipo-tramites/update/{id}', [TipoTramiteController::class, 'update'])->name('tipo-tramites.update');
        Route::delete('/dashboard/tipo-tramites/destroy/{id}', [TipoTramiteController::class, 'destroy'])->name('tipo-tramites.destroy');

        Route::get('/dashboard/flujo-tramites', [FlujoTramiteController::class, 'index'])->name('flujotramites.index');
        Route::get('/dashboard/flujo-tramites/create', [FlujoTramiteController::class, 'create'])->name('flujotramites.create');
        Route::post('/dashboard/flujo-tramites', [FlujoTramiteController::class, 'store'])->name('flujotramites.store');
        Route::get('/dashboard/flujo-tramites/{id}', [FlujoTramiteController::class, 'show'])->name('flujotramites.show');
        Route::get('/dashboard/flujo-tramites/edit/{id}', [FlujoTramiteController::class, 'edit'])->name('flujotramites.edit');
        Route::put('/dashboard/flujo-tramites/update/{id}', [FlujoTramiteController::class, 'update'])->name('flujotramites.update');
        Route::delete('/dashboard/flujo-tramites/destroy/{id}', [FlujoTramiteController::class, 'destroy'])->name('flujotramites.destroy');


        Route::get('/dashboard/flujo-documentos', [FlujoDocumentoController::class, 'index'])->name('flujo-documentos.index');
        Route::post('/dashboard/flujo-documentos/create', [FlujoDocumentoController::class, 'create'])->name('flujo-documentos.create');
        Route::post('/dashboard/flujo-documentos', [FlujoDocumentoController::class, 'store'])->name('flujo-documentos.store');
        Route::get('/dashboard/flujo-documentos/{id}', [FlujoDocumentoController::class, 'show'])->name('flujo-documentos.show');
        Route::get('/dashboard/flujo-documentos/edit/{id}', [FlujoDocumentoController::class, 'edit'])->name('flujo-documentos.edit');
        Route::put('/dashboard/flujo-documentos/update/{id}', [FlujoDocumentoController::class, 'update'])->name('flujo-documentos.update');
        Route::delete('/dashboard/flujo-documentos/destroy/{id}', [FlujoDocumentoController::class, 'destroy'])->name('flujo-documentos.destroy');

        Route::get('/flujos/buscar', [BuscarFlujoController::class, 'index'])->name('flujos.buscar');
        // Ruta para buscar el progreso de un documento específico
        Route::get('/flujos/progreso/{id}', [BuscarFlujoController::class, 'progreso'])->name('flujos.progreso');

    });


});

Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout');
