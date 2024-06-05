<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagedTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('teachers.index');
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
        return redirect()->route('teachers.index');
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
            'email' => 'required|email|unique:users,email,' . $id, // Updated unique validation
            'ci' => 'required|unique:users,ci,' . $id, // Updated unique validation
            'role' => 'required|numeric|in:1,2,3',
        ]);

        $teacher = User::find($id);

        if ($teacher) {
            $teacher->update($validatedData); // Update teacher attributes
            return redirect()->route('teachers.index'); // Redirect after successful update
        } else {
            return back()->withErrors(['message' => 'Teacher not found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
