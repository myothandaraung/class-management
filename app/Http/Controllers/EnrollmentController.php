<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Support\Facades\Log;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::all();
        return view('enrollments.index', compact('enrollments'));
    }
    public function create()
    {
        $stripe_key = env('STRIPE_KEY');
        $students = Student::join('users', 'students.user_id', '=', 'users.id')->where('users.is_deleted', null)->get();
        $classes = ClassModel::select('classes.id', 'classes.name','courses.price')->join('courses', 'classes.course_id', '=', 'courses.id')->where('classes.is_deleted', null)->get();
        Log::info($classes->toArray());
        return view('enrollments.create',compact('students','classes','stripe_key'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);
        Log::info($request->all());
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update([
            'status' => $request->status
        ]);
        return redirect()->route('enrollments.index')->with('success', '編集しました。');
    }

}
