<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleAsientoContable extends Model
{
    use HasFactory;

    protected $table = 'detalles_asientos_contables';

    protected $fillable = [
        'asiento_id',
        'cuenta_id',
        'tipo_movimiento',
        'monto'
    ];

    public function cuenta()
    {
        return $this->belongsTo(PlanCuentas::class);
    }

    public function asiento()
    {
        return $this->belongsTo(AsientoContable::class);
    }

    public function ejercicio()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(User::class, 'estudiante_id');
    }

    public static function findContable($id) {
        $contable = self::find($id);
        return $contable;
    }

    public static function getAllContables() {
        $contables = self::all();
        return $contables;
    }

    public static function getContablesByEjercicio($ejercicio_id) {
        $contables = self::where('ejercicio_id', $ejercicio_id)->get();
        return $contables;
    }

    public static function getContablesByEstudiante($estudiante_id) {
        $contables = self::where('estudiante_id', $estudiante_id)->get();
        return $contables;
    }
}
