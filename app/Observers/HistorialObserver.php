<?php
namespace App\Observers;

use App\Models\HistorialUsuario;
use Illuminate\Support\Facades\Auth;

class HistorialObserver
{
    public function created($model)
    {
        HistorialUsuario::create([
            'user_id' => Auth::id(),
            'accion' => 'crear_' . $this->getModelName($model),
            'descripcion' => 'Se ha creado un ' . $this->getModelName($model) . '.',
            $this->getModelColumnName($model) => $model->id,
        ]);
    }

    public function updated($model)
    {
        HistorialUsuario::create([
            'user_id' => Auth::id(),
            'accion' => 'editar_' . $this->getModelName($model),
            'descripcion' => 'Se ha editado un ' . $this->getModelName($model) . '.',
            $this->getModelColumnName($model) => $model->id,
        ]);
    }

    public function deleted($model)
    {
        HistorialUsuario::create([
            'user_id' => Auth::id(),
            'accion' => 'eliminar_' . $this->getModelName($model),
            'descripcion' => 'Se ha eliminado un ' . $this->getModelName($model) . '.',
            $this->getModelColumnName($model) => $model->id,
        ]);
    }

    private function getModelColumnName($model)
    {
        switch (get_class($model)) {
            case 'App\Models\Documento':
                return 'documento_id';
            case 'App\Models\FlujoTramite':
                return 'flujo_tramite_id';
            case 'App\Models\FlujoDocumento':
                return 'flujo_documento_id';
            case 'App\Models\Tramite':
                return 'tramite_id';
            case 'App\Models\Programa':
                return 'programa_id';
            case 'App\Models\User':
                return 'user_id';
            case 'Spatie\Permission\Models\Permission':
                return 'permission_id';
            case 'Spatie\Permission\Models\Role':
                return 'role_id';
            default:
                throw new \Exception('Modelo no soportado para historial.');
        }
    }

    private function getModelName($model)
    {
        return strtolower(class_basename($model));
    }
}