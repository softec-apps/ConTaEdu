<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $table = 'ejercicios';

    protected $fillable = [
        'titulo',
        'desc',
        'docente_id',
        'access_code',
    ];


    public static function getAllExercises()
    {
        return self::orderBy('created_at', 'desc')->get();
    }

    public static function getExerciseById($id)
    {
        return self::findOrFail($id);
    }

    public static function getByCode($code)
    {
        return self::where('access_code', $code)->firstOrFail();
    }

    // Internal method to get the user's assignments
    // Don't erase it
    public function asignaciones()
    {
        return $this->hasOne(Assignment::class, 'ejercicio_id');
    }

    public static function getAllByEstudianteId($id, $sent = null, $graded = null, $per_page = null, $additionalConditions = null)
    {
        $query = self::query();

        // Apply whereHas to ensure only exercises with matching assignments are fetched
        $query->whereHas('asignaciones', function ($query) use ($id, $sent, $graded) {
            $query->where('estudiante_id', $id);
            if (isset($sent)) {
                $query->where('sent', $sent);
            }
            if (isset($graded)) {
                if ($graded) {
                    $query->whereNotNull('grade');
                } else {
                    $query->whereNull('grade');
                }
            }
        });

        // Eager load the assignments with the same conditions
        $query->with('asignaciones', function ($query) use ($id, $sent, $graded) {
            $query->where('estudiante_id', $id);
            if (isset($sent)) {
                $query->where('sent', $sent);
            }
            if (isset($graded)) {
                if ($graded) {
                    $query->whereNotNull('grade');
                } else {
                    $query->whereNull('grade');
                }
            }
        });

        // Aplicar condiciones adicionales si se proporcionan
        if ($additionalConditions !== null && is_callable($additionalConditions)) {
            $additionalConditions($query);
        }

        if (isset($per_page)) {
            return $query->paginate($per_page);
        }
        return $query;
    }

    public static function getExerciseIfAssigned($exercise_id, $user_id)
    {
        $exercise = self::where('id', $exercise_id)
            ->whereHas('asignaciones', function ($query) use ($user_id) {
                $query->where('estudiante_id', $user_id);
            })
            ->first();

        return $exercise; // Retornará null si no se encuentra ningún ejercicio
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }
}
