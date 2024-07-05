<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManagetExerciseRequest;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Assignment;
use App\View\Components\Ejercicio\ModalQualification;
use App\Models\User;


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
        $exercise->titulo = $request->titulo;
        $exercise->desc = $request->desc;
        $exercise->docente_id = auth()->user()->id;

        $exercise->save();
        return redirect()->route('exercise.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $exercise = Exercise::getExerciseById($id);
        $exercise->delete();

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

        foreach ($grades as $studentId => $grade) {
            Assignment::where('ejercicio_id', $exerciseId)
                ->where('estudiante_id', $studentId)
                ->update(['grade' => $grade]);
        }

        return redirect()->back()->with('success', 'Calificaciones guardadas con éxito.');
    }

    public function viewSubmission($exerciseId, $studentId)
    {
        $assignment = Assignment::where('ejercicio_id', $exerciseId)
            ->where('estudiante_id', $studentId)
            ->where('sent', true)
            ->firstOrFail();

        $exercise = Exercise::findOrFail($exerciseId);
        $student = User::findOrFail($studentId);

        return view('docente.manageExercises.view-submission', [
            'exercise' => $exercise,
            'student' => $student,
            'assignment' => $assignment
        ]);
    }
}
