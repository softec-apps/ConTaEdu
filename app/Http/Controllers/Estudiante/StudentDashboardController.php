<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\Assignment;

class StudentDashboardController extends Controller
{
    protected function checkExistence($id, $student_id = null)
    {
        $exercise = Exercise::getExerciseIfAssigned($id, $student_id ?? \Auth::id());
        if (!isset($exercise)) {
            abort(404);
        }
        return $exercise;
    }


    public function index()
    {
        $perPage = 4;

        $total_exercises = Exercise::getAllByEstudianteId(\Auth::id())->count();
        $exercises_sent = Exercise::getAllByEstudianteId(\Auth::id(), true)->get();
        $graded_exercises = Exercise::getAllByEstudianteId(\Auth::id(), null, true)->get();
        $data = [
            'stats' => [
                'total_exercises' => $total_exercises,
                'exercises_sent' => $exercises_sent->count(),
                'graded_exercises' => $graded_exercises->count()
            ],
            'pending_exercises' => Exercise::getAllByEstudianteId(\Auth::id(), false, false)->take($perPage)->get(),
            'sent_graded_exercises' => $exercises_sent->merge($graded_exercises)->unique('id')->values()->take($perPage),
        ];
        return view('estudiante.dashboard', $data);
    }

    public function searchExercise(Request $request)
    {
        try {
            // Validar datos
            $validatedData = $request->validate([
                'access-code' => 'required|min:6|max:6',
            ]);
            // $accessCode = Exercise::where('access_code', $validatedData['accessCode'])->first();
            $accessCode = $validatedData['access-code'];
            $exerciseFound = Exercise::getByCode($accessCode);

            if (empty($exerciseFound)) {
                throw new \Exception('Código no encontrado');
            }

            return response()->json(['success' => true, 'message'=>'Encontrado', 'data' => $exerciseFound], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se pudo encontrar el ejercicio',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function joinExercise(Request $request)
    {
        try {
            // Validar datos
            $validatedData = $request->validate([
                'access-code' => 'required|min:6|max:6',
            ]);
            $accessCode = $validatedData['access-code'];
            $exerciseFound = Exercise::getByCode($accessCode);

            if (empty($exerciseFound)) {
                throw new \Exception('Código no encontrado');
            }

            $newJoin = Assignment::newAssignment($exerciseFound->id, \Auth::id());
            if (!$newJoin) {
                swal()->error(null, 'Ya se unió al ejercicio')->toast();
                throw new \Exception('No se pudo unir al ejercicio');
            }

            swal()->success(null, 'Se unió correctamente al ejercicio')->toast();
            return redirect()->route('estudiante.dashboard');
        } catch (\Illuminate\Validation\ValidationException $e) {
            swal()->error(null, 'Código no encontrado')->toast();
            return redirect()->route('estudiante.dashboard')->with('error', $e->errors());
        } catch (\Exception $e) {
            swal()->error(null, 'No se pudo unir al ejercicio')->toast();
            return redirect()->route('estudiante.dashboard')->with('error', $e->getMessage());
        }
    }

    public function leaveExercise(Request $request)
    {
        $id = $request->get('exercise_id');
        try {
            $exercise = self::checkExistence($id, auth()->id());

            $exercise->asignaciones()->where('estudiante_id', auth()->id())->delete();

            swal()->success(null, 'Acaba de salir del ejercicio')->toast();
            return redirect()->route('estudiante.pending_exercises');
        } catch(\Exception $e) {
            // Si el ejercicio no existe
            swal()->error(null, 'No fue posible encontrar el ejercicio o salir del mismo')->toast();
            return redirect()->route('estudiante.pending_exercises');
        }
    }


    public function pendingExercises()
    {
        $perPage = 8;
        $data = [
            'exercises' => Exercise::getAllByEstudianteId(\Auth::id(), false, false, $perPage),
        ];
        return view('estudiante.pending_exercises', $data);
    }

    public function searchPending(Request $request)
    {
        $searchTerm = $request->input('searchdocs');
        $perPage = 8;
        $exercises = Exercise::getAllByEstudianteId(\Auth::id(), false, null, $perPage,
            function($query) use ($searchTerm) {
                $query->where('titulo', 'like', '%' . $searchTerm . '%');
            }
        );

        return view('estudiante.pending_exercises', compact('exercises'));
    }


    public function sentGradedExercises()
    {
        $perPage = 8;
        $data = [
            'exercises' => Exercise::getAllByEstudianteId(\Auth::id(), true, null, $perPage),
        ];
        return view('estudiante.sent_graded_exercises', $data);
    }

    public function searchSent(Request $request)
    {
        $searchTerm = $request->input('searchdocs');
        $perPage = 8;
        $exercises = Exercise::getAllByEstudianteId(\Auth::id(), true, null, $perPage,
            function($query) use ($searchTerm) {
                $query->where('titulo', 'like', '%' . $searchTerm . '%');
            }
        );

        return view('estudiante.sent_graded_exercises', compact('exercises'));
    }
}
