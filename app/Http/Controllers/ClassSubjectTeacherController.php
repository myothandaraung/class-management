<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassSubjectTeacher;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\Teacher;

class ClassSubjectTeacherController extends Controller
{
    public function index()
    {
        $classSubjectTeachers = ClassSubjectTeacher::with(['class', 'subject', 'teacher'])
            ->whereNull('is_deleted')
            ->get();
        return view('classSubjectTeachers.index', compact('classSubjectTeachers'));
    }

    public function create()
    {
        $classes = ClassModel::whereNull('is_deleted')->get();
        $subjects = Subject::whereNull('is_deleted')->get();
        $teachers = Teacher::select('teachers.id', 'teachers.first_name', 'teachers.last_name')->join('users', 'teachers.user_id', '=', 'users.id')->whereNull('users.is_deleted')->get();
        return view('classSubjectTeachers.create', compact('classes', 'subjects', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        ClassSubjectTeacher::create([
            'class_id' => $validated['class_id'],
            'subject_id' => $validated['subject_id'],
            'teacher_id' => $validated['teacher_id'],
            'is_deleted' => null,
        ]);

        return redirect()->route('classSubjectTeachers.index')
            ->with('success', '関連が追加されました');
    }

    public function show(ClassSubjectTeacher $classSubjectTeacher)
    {
        $classSubjectTeacher = ClassSubjectTeacher::with(['class', 'subject', 'teacher'])
            ->whereNull('is_deleted')
            ->where('id', $classSubjectTeacher->id)
            ->first();
        return view('classSubjectTeachers.show', compact('classSubjectTeacher'));
    }
    public function edit(ClassSubjectTeacher $classSubjectTeacher)
    {
        $classes = ClassModel::whereNull('is_deleted')->get();
        $subjects = Subject::whereNull('is_deleted')->get();
        $teachers = Teacher::select('teachers.id', 'teachers.first_name', 'teachers.last_name')->join('users', 'teachers.user_id', '=', 'users.id')->whereNull('users.is_deleted')->get();
        return view('classSubjectTeachers.edit', compact('classSubjectTeacher', 'classes', 'subjects', 'teachers'));
    }

    public function update(Request $request, ClassSubjectTeacher $classSubjectTeacher)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $classSubjectTeacher->update([
            'class_id' => $validated['class_id'],
            'subject_id' => $validated['subject_id'],
            'teacher_id' => $validated['teacher_id'],
        ]);

        return redirect()->route('classSubjectTeachers.index')
            ->with('success', '関連が更新されました');
    }

    public function destroy(ClassSubjectTeacher $classSubjectTeacher)
    {
        $classSubjectTeacher->update(['is_deleted' => true]);
        return redirect()->route('classSubjectTeachers.index')
            ->with('success', '関連が削除されました');
    }
}
