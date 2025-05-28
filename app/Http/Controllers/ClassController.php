<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::with(['course'])
            ->whereNull('is_deleted')
            ->get();
        
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        $courses = Course::whereNull('is_deleted')->get();
        return view('classes.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $filename = null;
        if ($request->hasFile('thumbnail')) {
            $filename = Storage::disk('public')->putFile('classes', $request->file('thumbnail'));
        }
        ClassModel::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'course_id' => $validated['course_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'thumbnail' => $filename,
        ]);

        return redirect()->route('classes.index')->with('success', 'クラスが追加されました');
    }

    public function show(ClassModel $class)
    {
        return view('classes.show', compact('class'));
    }

    public function edit(ClassModel $class)
    {
        $courses = Course::whereNull('is_deleted')->get();
        return view('classes.edit', compact('class', 'courses'));
    }

    public function update(Request $request, ClassModel $class)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $filename = null;
        if ($request->hasFile('thumbnail')) {
            if($class->thumbnail){
                Storage::disk('public')->delete($class->thumbnail);
            }
            $filename = Storage::disk('public')->putFile('classes', $request->file('thumbnail'));
            $class->update([
                'thumbnail' => $filename
            ]);
        }
        $class->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'course_id' => $validated['course_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);

        return redirect()->route('classes.index')->with('success', 'クラスが更新されました');
    }

    public function destroy(ClassModel $class)
    {
        $class->update(['is_deleted' => true]);

        return redirect()->route('classes.index')->with('success', 'クラスが削除されました');
    }
}
