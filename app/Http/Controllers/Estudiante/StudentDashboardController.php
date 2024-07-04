<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\Assignment;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $perPage = 4;

        $total_exercises = Exercise::getAllByEstudianteId(\Auth::id());
        $exercises_sent = Exercise::getAllByEstudianteId(\Auth::id(), true);
        $graded_exercises = Exercise::getAllByEstudianteId(\Auth::id(), null, true);
        $data = [
            'stats' => [
                'total_exercises' => $total_exercises->count(),
                'exercises_sent' => $exercises_sent->count(),
                'graded_exercises' => $graded_exercises->count()
            ],
            'pending_exercises' => Exercise::getAllByEstudianteId(\Auth::id(), false, false)->splice(0, $perPage),
            'sent_graded_exercises' => $exercises_sent->merge($graded_exercises)->unique('id')->values()->splice(0, $perPage),
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
                throw new \Exception('No se pudo unir al ejercicio');
            }

            return redirect()->route('estudiante.dashboard');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('estudiante.dashboard')->with('error', $e->errors());
        } catch (\Exception $e) {
            return redirect()->route('estudiante.dashboard')->with('error', $e->getMessage());
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


    public function sentGradedExercises()
    {
        $perPage = 8;
        $data = [
            'exercises' => Exercise::getAllByEstudianteId(\Auth::id(), true, null, $perPage),
        ];
        return view('estudiante.sent_graded_exercises', $data);
    }
}
