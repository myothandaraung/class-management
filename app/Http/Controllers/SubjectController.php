<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Support\Facades\Log;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with(['courses', 'teachers'])->get();
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        $teachers = Teacher::all();
        $teachers->each(function($teacher){
            $teacher->name = $teacher->getFullNameAttribute();
        });
        Log::info($courses);
        Log::info($teachers);
        return view('subjects.create', compact('courses', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:subjects',
            'type' => 'required|string|in:必修,選択,特別',
            'description' => 'nullable|string',
            'courses' => 'required|array|min:1',
            'courses.*' => 'exists:courses,id',
            'teachers' => 'required|array|min:1',
            'teachers.*' => 'exists:teachers,id',
        ]);

        $subject = Subject::create([
            'name' => $validated['name'],
            'code' => $validated['code'],
            'type' => $validated['type'],
            'description' => $validated['description'],
        ]);

        $subject->courses()->attach($validated['courses']);
        $subject->teachers()->attach($validated['teachers']);

        return redirect()->route('subjects.index')
            ->with('success', '科目を追加しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        $subject->load('courses', 'teachers');
        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $courses = Course::all();
        $teachers = Teacher::all();
        return view('subjects.edit', compact('subject', 'courses', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:subjects,code,' . $subject->id,
            'type' => 'required|string|in:必修,選択,特別',
            'description' => 'nullable|string',
            'courses' => 'required|array|min:1',
            'courses.*' => 'exists:courses,id',
            'teachers' => 'required|array|min:1',
            'teachers.*' => 'exists:teachers,id',
        ]);

        $subject->update([
            'name' => $validated['name'],
            'code' => $validated['code'],
            'type' => $validated['type'],
            'description' => $validated['description'],
        ]);

        $subject->courses()->sync($validated['courses']);
        $subject->teachers()->sync($validated['teachers']);

        return redirect()->route('subjects.index')
            ->with('success', '科目を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->courses()->detach();
        $subject->teachers()->detach();
        $subject->delete();

        return redirect()->route('subjects.index')
            ->with('success', '科目を削除しました');
    }
}
