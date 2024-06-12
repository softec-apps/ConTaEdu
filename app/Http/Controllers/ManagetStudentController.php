<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManageStudentRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

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
        $student = new User();
        $student->ci = $request->ci;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = Hash::make($request->ci);
        $student->role = 3;

        $student->save();

        return view('docente.manageStudent.index');
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
        $user = User::getUsersById($id);
        return view('docente.manageStudent.edit', ['user' => $user, 'id' => $id]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(ManageStudentRequest $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->fill($request->validated());
            $user->save();
        }

        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::getUsersById($id);
        $user->delete();
        return response()->json(['success' => true]);
    }
}
