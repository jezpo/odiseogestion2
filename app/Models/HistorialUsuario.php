<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialUsuario extends Model
{
    use HasFactory;

    protected $table = 'historial_usuarios';

    protected $fillable = [
        'user_id', 
        'accion', 
        'documento_id', 
        'flujo_tramite_id', 
        'flujo_documento_id', 
        'tramite_id', 
        'programa_id'
    ];

    // Relaciones con otros modelos
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function documento()
    {
        return $this->belongsTo(Documento::class, 'documento_id');
    }

    public function flujoTramite()
    {
        return $this->belongsTo(FlujoTramite::class, 'flujo_tramite_id');
    }

    public function flujoDocumento()
    {
        return $this->belongsTo(FlujoDocumento::class, 'flujo_documento_id');
    }

    public function tramite()
    {
        return $this->belongsTo(TipoTramite::class, 'tramite_id');
    }

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'programa_id');
    }
}