<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\AsientoContable;
use App\Models\DetalleAsientoContable;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Validator;

class SolveExerciseController extends Controller
{
    protected function checkExistence($id)
    {
        $exercise = Exercise::getExerciseIfAssigned($id, \Auth::id());
        if (!isset($exercise)) {
            abort(404);
        }
        return $exercise;
    }

    public function index(Request $request)
    {
        $idExercise = $request->id;
        $exercise = self::checkExistence($idExercise);

        // Actualizar la vista del ejercicio de ser necesario
        if (!$exercise->asignaciones->viewed) {
            $exercise->asignaciones()->update(['viewed' => true]);
        }

        // Obtener los asientos contables del ejercicio y del usuario actual
        $asientosContables = AsientoContable::where('ejercicio_id', $idExercise)
            ->where('estudiante_id', auth()->id())
            ->orderBy('fecha', 'asc')
            ->get();

        $data = [
            'exercise' => $exercise,
            'asientosContables' => $asientosContables
        ];
        return view('estudiante.exercise', $data);
    }

    public function new_detalle_asiento_contable(Request $request)
    {
        $index = $request->input('index',0);

        return view('components.estudiante.detalle-asiento-modal', ['index' => $index]);
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'exercise_id' => 'required|exists:ejercicios,id',
                'date' => 'required|date',
                'concept' => 'nullable|string|max:1000',
                'cuentas' => 'required|array',
                'cuentas.*.account_id' => 'required|exists:plan_cuentas,id',
                'cuentas.*.amount' => 'required|numeric|min:0.01',
                'cuentas.*.type' => 'required|in:debe,haber',
            ];

            // Validar datos
            $validator = Validator::make($request->all(), $rules);

            // Si la validación pasa, obtener los datos validados
            $validatedData = $validator->validated();

            $exerciseId = $validatedData['exercise_id'];
            $fecha = $validatedData['date'];
            $cuentas = $validatedData['cuentas'];
            $concepto = $validatedData['concept'];

            // Verificar existencia del ejercicio
            $exercise = self::checkExistence($exerciseId);

            // Iniciar transacción
            \DB::beginTransaction();

            // Crear el asiento contable
            $asiento = AsientoContable::create([
                'estudiante_id' => \Auth::id(),
                'ejercicio_id' => $exercise->id,
                'fecha' => $fecha,
                'concepto' => $concepto
            ]);

            // Crear los detalles del asiento contable
            foreach ($cuentas as $cuenta) {
                DetalleAsientoContable::create([
                    'asiento_id' => $asiento->id,
                    'cuenta_id' => $cuenta['account_id'],
                    'tipo_movimiento' => $cuenta['type'],
                    'monto' => $cuenta['amount']
                ]);
            }

            // Confirmar transacción
            \DB::commit();

            swal()->success('Registro', 'Asiento registrado con éxito')->toast();
            return redirect()->route('estudiante.see_exercise', ['id' => $exerciseId]);
        } catch (ValidationException $e) {
            \DB::rollBack();
            return redirect()->back()
                             ->withErrors($e->validator)
                             ->withInput();
        } catch (\Exception $e) {
            // Revertir transacción
            \DB::rollBack();
            swal()->error('Error', 'No fue posible registrar la transacción')->toast();
            return redirect()->back()->withInput();
        }
    }

    public function sendExercise(Request $request)
    {
        try {
            $exerciseId = $request->id;
            // Verificar existencia del ejercicio
            $exercise = self::checkExistence($exerciseId);

            // Enviar el ejercicio
            $exercise->asignaciones()->update(['sent' => true]);

            swal()->success(null, 'Ejercicio enviado con éxito')->toast();
            return redirect()->back();
        } catch (\Exception $e) {
            swal()->error(null, 'No fue posible enviar tus respuestas')->toast();
            return redirect()->back();
        }
    }
}
