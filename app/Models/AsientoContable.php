<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsientoContable extends Model
{
    use HasFactory;

    protected $table = 'asientos_contables';

    protected $fillable = [
        'estudiante_id',
        'ejercicio_id',
        'fecha',
        'concepto'
    ];

    public function estudiante()
    {
        return $this->belongsTo(User::class, 'estudiante_id');
    }

    public function ejercicio()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleAsientoContable::class, 'asiento_id');
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

    public static function createContable($request) {
        $contable = self::create($request->all());
        return $contable;
    }

    public static function updateContable($request, $id) {
        $contable = self::find($id);
        if (!$contable) {
            return false;
        }
        $contable->update($request->all());
        return $contable;
    }

    public static function deleteContable($id) {
        $contable = self::find($id);
        if (!$contable) {
            return false;
        }
        $contable->delete();
        return true;
    }
}
