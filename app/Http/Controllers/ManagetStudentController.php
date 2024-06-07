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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
