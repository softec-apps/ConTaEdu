<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exercise;

class Assignment extends Model
{
    use HasFactory;

    protected $table = 'asignaciones';

    protected $fillable = [
        'estudiante_id',
        'ejercicio_id',
        'grade',
        'viewed',
        'sent',
    ];

    public static function newAssignment($ejercicio_id, $estudiante_id)
    {
        // Check if the combination of ejercicio_id and estudiante_id already exists
        $existingAssignment = self::where('ejercicio_id', $ejercicio_id)
            ->where('estudiante_id', $estudiante_id)
            ->first();

        if ($existingAssignment) {
            // Return false or handle the duplicate case as needed
            return false; // or you could return a message or throw an exception
        }

        // Create a new assignment
        $assignment = new self();
        $assignment->ejercicio_id = $ejercicio_id;
        $assignment->estudiante_id = $estudiante_id;
        return $assignment->save();
    }


    public static function getStudentsAssignedToExercise($ejercicio_id)
    {
        return self::where('ejercicio_id', $ejercicio_id)
            ->with('estudiante:id,name,email')
            ->get();
    }

    // Relación con el modelo User (estudiante)
    public function estudiante()
    {
        return $this->belongsTo(User::class, 'estudiante_id');
    }

    public function getStudentResponse()
    {
        // Asumiendo que guardas la respuesta en algún lugar, por ejemplo, en una columna 'response'
        return $this->response;
    }

    public static function getRelatedStudentCountForTeacher($docenteId)
    {
        return self::whereHas('exercise', function ($query) use ($docenteId) {
            $query->where('docente_id', $docenteId);
        })
            ->select('estudiante_id')
            ->distinct()
            ->count();
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'ejercicio_id');
    }
}
