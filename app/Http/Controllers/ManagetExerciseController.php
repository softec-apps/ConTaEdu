<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManagetExerciseRequest;
use App\Models\AsientoContable;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Assignment;
use App\View\Components\Ejercicio\ModalQualification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ManagetExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 8;
        $exercises = Exercise::orderBy('created_at', 'desc')->paginate($perPage);

        return view('docente.manageExercises.index', ['exercises' => $exercises]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('docente.manageExercises.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ManagetExerciseRequest $request)
    {
        $exercise = new Exercise();
        $exercise->titulo = $request->titulo;
        $exercise->desc = $request->desc;
        $exercise->docente_id = auth()->user()->id;
        $exercise->access_code = Str::random(6);

        $exercise->save();

        swal()->success('Ejercicio creado', 'El ejercicio se ha guardado correctamente')->toast();

        return redirect()->route('exercise.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $exercise = Exercise::getExerciseById($id);
        return view('docente.manageExercises.show', ['exercise' => $exercise]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $exercise = Exercise::getExerciseById($id);
        return view('docente.manageExercises.edit', ['exercise' => $exercise]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ManagetExerciseRequest $request, $id)
    {
        $exercise = Exercise::getExerciseById($id);

        if ($exercise) {
            $exercise->titulo = $request->titulo;
            $exercise->desc = $request->desc;
            $exercise->docente_id = auth()->user()->id;

            $exercise->save();

            swal()->success('Ejercicio actualizado', 'El ejercicio se ha actualizado correctamente')->toast();
        } else {
            swal()->error('Error', 'No se encontró el ejercicio')->toast();
        }

        return redirect()->route('exercise.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $exercise = Exercise::getExerciseById($id);

        if ($exercise) {
            $exercise->delete();
            swal()->success('Ejercicio eliminado', 'El ejercicio se ha eliminado correctamente')->toast();
        } else {
            swal()->error('Error', 'No se encontró el ejercicio a eliminar')->toast();
        }

        return redirect()->route('exercise.index');
    }

    /**
     * Update the viewed status of the assignment.
     */
    public function updateViewed(Request $request, $id)
    {
        $assignment = Assignment::getAssignmentById($id);
        $assignment->viewed = true;
        $assignment->save();
        return response()->json(['message' => 'success']);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchdocs');
        $perPage = 8;
        $exercises = Exercise::where('titulo', 'like', '%' . $searchTerm . '%')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('docente.manageExercises.index', compact('exercises'));
    }

    public function indexp(Request $request)
    {
        $page = $request->input('page', 1);  // Get the page number from the request or set a default
        $perPage = 8; // Number of exercises per page (adjust as needed)

        $exercises = Exercise::paginate($perPage); // Use pagination with perPage limit

        return view('docente.manageExercises.index', compact('exercises'));
    }

    public function getAssignedStudents($id)
    {
        $exercise = Exercise::getExerciseById($id);

        if (!$exercise) {
            return redirect()->route('exercise.index')->with('error', 'Ejercicio no encontrado');
        }

        $assignedStudents = Assignment::where('ejercicio_id', $id)
            ->with('estudiante:id,name,email')
            ->get()
            ->pluck('estudiante')
            ->unique('id')
            ->values();

        return view('docente.manageExercises.assigned-students', [
            'exercise' => $exercise,
            'assignedStudents' => $assignedStudents
        ]);
    }

    public function saveGrades(Request $request, $exerciseId)
    {
        $grades = $request->input('grades');

        try {
            foreach ($grades as $studentId => $grade) {
                Assignment::where('ejercicio_id', $exerciseId)
                    ->where('estudiante_id', $studentId)
                    ->update(['grade' => $grade]);
            }

            // Añadimos la alerta toast de éxito aquí
            swal()->success('Calificaciones guardadas', 'Las calificaciones se han guardado correctamente')->toast();

            return redirect()->back();
        } catch (\Exception $e) {
            // Alerta toast de error si ocurre algún problema
            swal()->error('Error', 'Hubo un problema al guardar las calificaciones')->toast();

            return redirect()->back();
        }
    }

    public function viewSubmission($exerciseId, $studentId)
    {
        $assignment = Assignment::where('ejercicio_id', $exerciseId)
            ->where('estudiante_id', $studentId)
            ->where('sent', true)
            ->firstOrFail();

        $exercise = Exercise::findOrFail($exerciseId);
        // $student = User::findOrFail($studentId);
        $asientosContables = AsientoContable::where('ejercicio_id', $exerciseId)
            ->where('estudiante_id', $studentId)
            ->orderBy('fecha', 'asc')
            ->get();

        return view('estudiante.exercise', [
            'exercise' => $exercise,
            // 'student' => $student,
            // 'assignment' => $assignment
            'asientosContables' => $asientosContables
        ]);
    }

    public function getExerciseCount()
    {
        $docenteId = auth()->user()->id;
        $count = Exercise::getExerciseCountByDocente($docenteId);
        return response()->json(['count' => $count]);
    }

    public function getGradedExerciseCount()
    {
        $docenteId = auth()->user()->id;
        $count = Exercise::getGradedExerciseCountByDocente($docenteId);
        return response()->json(['count' => $count]);
    }

    public function getRelatedStudentCount()
    {
        $docenteId = auth()->user()->id;
        $count = Assignment::getRelatedStudentCountForTeacher($docenteId);
        return response()->json(['count' => $count]);
    }


    public function getCreatedExercisesData(Request $request)
    {
        $period = $request->input('period', 'week');
        $endDate = Carbon::now();
        $startDate = $this->getStartDate($period);

        $data = Exercise::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as exercise_count')
        )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'labels' => $data->pluck('date'),
            'values' => $data->pluck('exercise_count')
        ]);
    }

    private function getStartDate($period)
    {
        switch ($period) {
            case 'today':
                return Carbon::today();
            case 'week':
                return Carbon::now()->subWeek();
            case 'month':
                return Carbon::now()->subMonth();
            case 'year':
                return Carbon::now()->subYear();
            default:
                return Carbon::now()->subWeek();
        }
    }
}
