<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index');
    }
    
    public function getUsers($id, Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('role', $id)->get();
            return datatables()->of($data)->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manageStudent.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'ci' => 'required|unique:users',
            'role' => 'required|numeric|in:1,2,3',
        ]);
        $user = User::create([
            'name' => $request->name,
            'role' => $validatedData['role'],
            'email' => $request->email,
            'ci' => $request->ci,
            'password' => Hash::make($request->ci),
        ]);
        return redirect()->route('users.index');
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
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'ci' => 'required|unique:users,ci,' . $id,
            'role' => 'required|numeric|in:1,2,3',
        ]);
        $teacher = User::find($id);
        if ($teacher) {
            $teacher->update($validatedData);
            return redirect()->route('users.index');
        } else {
            return back()->withErrors(['message' => 'Teacher not found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function estado($id)
    {
        $teacher = User::find($id);
        if ($teacher) {
            $teacher->est = $teacher->est == 1 ? 0 : 1;
            $teacher->save();
            return response()->json(['success', true]);
        } else {
            return response()->json(['success', false]);
            //return back()->withErrors(['message' => 'Teacher not found']);
        }
    }


    public function destroy($id)
    {
        $teacher = User::find($id);
        if ($teacher) {
            $teacher->est = 1 ? $teacher->est = 0 : $teacher->est = 1;
            $teacher->update($teacher);
            return redirect()->route('users.index');
        } else {
            return back()->withErrors(['message' => 'Teacher not found']);
        }
    }
}
