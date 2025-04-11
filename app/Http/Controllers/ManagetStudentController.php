<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManageStudentRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Assignment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ManagetStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(User::where('role', 3)->get())
                ->make(true);
        }
        return view('docente.manageStudent.index');
    }

    // public function index()
    // {
    //     $users = User::where('role', 3)->get();
    //     return view('docente.manageStudent.index', ['users' => $users]);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('docente.manageStudent.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ManageStudentRequest $request)
    {
        try {
            $validator = \Validator::make($request->all(), ([
                'ci' => 'required|numeric|min_digits:10|max_digits:10|unique:users,ci',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
            ]
            ));

            if ($validator->fails()) {
                swal()->error('Error', 'El estudiante ya existe')->toast();
                return back()->withErrors($validator)->withInput();
            }

            $student = new User();
            $student->ci = $request->ci;
            $student->name = $request->name;
            $student->email = $request->email;
            $student->password = Hash::make($request->ci);
            $student->role = 3;

            $student->save();

            swal()->success('Éxito', 'Estudiante registrado correctamente')->toast();

            return view('docente.manageStudent.index');
        }catch (\Exception $e) {
            swal()->error('Error', 'No se pudo registrar el estudiante: ' . $e->getMessage())->toast();
            return back()->withErrors(['message' => 'Error al registrar el estudiante: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = User::find($id);

        if ($student) {
            return response()->json([
                'ci' => $student->ci,
                'name' => $student->name,
                'email' => $student->email,
            ]);
        } else {
            return response()->json(['error' => 'Student not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $user = User::getUsersById($id);
            return view('docente.manageStudent.edit', ['user' => $user, 'id' => $id]);
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Error al editar el estudiante: ' . $e->getMessage()]);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(ManageStudentRequest $request, $id)
    {
        try {
            $user = User::find($id);

            if ($user) {
                $request->validate([
                    'ci' => 'required|numeric|min_digits:10|max_digits:10|unique:users,ci,' . $id,
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|max:255|unique:users,email,' . $id,
                ]);

                $user->fill($request->validated());
                $user->save();
                swal()->success('Actualización exitosa', 'La información del estudiante ha sido actualizada')->toast();
            } else {
                swal()->error('Error', 'No se encontró el estudiante')->toast();
            }

            return redirect()->route('student.index');
        } catch (\Exception $e) {
            swal()->error('Error', 'No se pudo actualizar el estudiante: ' . $e->getMessage())->toast();
            return back()->withErrors(['message' => 'Error al actualizar el estudiante: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::getUsersById($id);
            $user->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al eliminar el estudiante: ' . $e->getMessage()]);
        }
    }

    public function getProgressChartData(Request $request)
    {
        $period = $request->input('period', 'week');
        $endDate = Carbon::now();
        $startDate = $this->getStartDate($period);

        $data = Assignment::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('AVG(grade) as average_grade')
        )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'labels' => $data->pluck('date'),
            'values' => $data->pluck('average_grade')
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

    public function changePassword(Request $request, $id)
    {
        try {
            $request->validate([
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::find($id);

            if ($user) {
                $user->password = Hash::make($request->new_password);
                $user->save();
                return response()->json(['success' => true, 'message' => 'La contraseña del estudiante ha sido actualizada']);
            }

            return response()->json(['success' => false, 'message' => 'Usuario no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al cambiar la contraseña: ' . $e->getMessage()]);
        }
    }
}
