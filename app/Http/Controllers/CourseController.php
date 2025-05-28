<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Department;
use App\Models\ClassModel;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with(['department'])->get();
        $courses->each(function($course){
            $class = ClassModel::where('course_id', $course->id)->get();
            $subjects = Subject::whereHas('courses', function($query) use ($course){
                            $query->where('course_id', $course->id);
                        })->where('is_deleted', null)->get();
            $course->subjects = $subjects->toArray();
            $course->classes = $class->toArray();
        });
        return view('courses.index', compact('courses'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $course->load(['department']);
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::where('is_deleted', null)->get();
        return view('courses.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'year' => 'required|integer|min:' . (date('Y') - 5) . '|max:' . date('Y'),
        ]);
        $course = Course::create([
            'name' => $validated['name'],
            'department_id' => $validated['department_id'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'year' => $validated['year'],
        ]);

        return redirect()->route('courses.index')
            ->with('success', 'コースを追加しました');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $departments = Department::all();
        return view('courses.edit', compact('course', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'year' => 'required|integer|min:' . (date('Y') - 5) . '|max:' . date('Y'),
            'price' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        $course->update($validated);

        return redirect()->route('courses.show', $course)
            ->with('success', 'コースを更新しました');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {     
        $course->update([
            'is_deleted' => true,
        ]);
        Subject::where('course_id', $course->id)->update([
            'is_deleted' => true,
        ]);
        return redirect()->route('courses.index')
            ->with('success', 'コースを削除しました');
    }
}
