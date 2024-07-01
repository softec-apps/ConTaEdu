<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    use HasFactory;

    protected $table = 'asignaciones';

    protected $fillable = [
        'ejercicio_id',
        'estudiante_id',
        'nota',
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
}
