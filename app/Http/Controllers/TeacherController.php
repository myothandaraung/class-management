<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = \App\Models\Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers',
            'phone' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'gender' => 'nullable|string',
            'qualification' => 'nullable|string',
            'specialization' => 'nullable|string',
            'employee_id' => 'nullable|string',
            'designation' => 'nullable|string',
            'department' => 'nullable|string',
            'role' => 'nullable|string'
        ]);

        \App\Models\Teacher::create($validated);

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = \App\Models\Teacher::findOrFail($id);
        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = \App\Models\Teacher::findOrFail($id);
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher = \App\Models\Teacher::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $id,
            'phone' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'gender' => 'nullable|string',
            'qualification' => 'nullable|string',
            'specialization' => 'nullable|string',
            'employee_id' => 'nullable|string',
            'designation' => 'nullable|string',
            'department' => 'nullable|string',
            'role' => 'nullable|string'
        ]);

        $teacher->update($validated);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = \App\Models\Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully');
    }
}
