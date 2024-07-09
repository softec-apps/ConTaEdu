<?php

namespace App\View\Components\Ejercicio;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Exercise;
use App\Models\Assignment;
use Illuminate\Support\Facades\DB;

class ModalQualification extends Component
{
    public $exercise;
    public $assignedStudents;

    // public function __construct($exerciseId)
    // {
    //     $this->exercise = Exercise::findOrFail($exerciseId);

    //     $this->assignedStudents = Assignment::where('ejercicio_id', $exerciseId)
    //         ->with('estudiante:id,name,email')
    //         ->get();
    // }

    public function __construct($exerciseId)
    {
        $this->exercise = Exercise::findOrFail($exerciseId);

        $this->assignedStudents = Assignment::getStudentsAssignedToExercise($exerciseId);
    }

    public function render(): View|Closure|string
    {
        return view('components.ejercicio.modal-qualification', [
            'exercise' => $this->exercise,
            'assignedStudents' => $this->assignedStudents
        ]);
    }

    public function saveGrades($grades)
    {
        DB::beginTransaction();
        try {
            foreach ($grades as $studentId => $grade) {
                Assignment::where('ejercicio_id', $this->exercise->id)
                    ->where('estudiante_id', $studentId)
                    ->update(['grade' => $grade]);
            }
            DB::commit();
            return ['success' => true, 'message' => 'Calificaciones guardadas con éxito.'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => 'Error al guardar las calificaciones: ' . $e->getMessage()];
        }
    }
}
