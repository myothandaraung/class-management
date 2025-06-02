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
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'class_id' => 'required',
            'enrollment_date' => 'required',
        ]);
        Log::info($request->all());
        // Enrollment::create([
        //     'student_id' => $request->student_id,
        //     'class_id' => $request->class_id,
        //     'enrollment_date' => $request->enrollment_date,
        //     'status' => 'active',
        // ]);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment created successfully.');
    }
}
