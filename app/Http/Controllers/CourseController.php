<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with(['subjects', 'teachers'])->get();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        $teachers = Teacher::all();
        return view('courses.create', compact('subjects', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|integer|min:' . (date('Y') - 5) . '|max:' . date('Y'),
            'subjects' => 'required|array|min:1',
            'subjects.*' => 'exists:subjects,id',
            'teachers' => 'required|array|min:1',
            'teachers.*' => 'exists:teachers,id',
        ]);

        $course = Course::create([
            'name' => $validated['name'],
            'year' => $validated['year'],
        ]);

        $course->subjects()->attach($validated['subjects']);
        $course->teachers()->attach($validated['teachers']);

        return redirect()->route('courses.index')
            ->with('success', 'コースを追加しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $course->load('subjects', 'teachers');
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $subjects = Subject::all();
        $teachers = Teacher::all();
        return view('courses.edit', compact('course', 'subjects', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|integer|min:' . (date('Y') - 5) . '|max:' . date('Y'),
            'subjects' => 'required|array|min:1',
            'subjects.*' => 'exists:subjects,id',
            'teachers' => 'required|array|min:1',
            'teachers.*' => 'exists:teachers,id',
        ]);

        $course->update([
            'name' => $validated['name'],
            'year' => $validated['year'],
        ]);

        $course->subjects()->sync($validated['subjects']);
        $course->teachers()->sync($validated['teachers']);

        return redirect()->route('courses.index')
            ->with('success', 'コースを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->subjects()->detach();
        $course->teachers()->detach();
        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'コースを削除しました');
    }
}
